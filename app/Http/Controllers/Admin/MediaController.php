<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class MediaController extends Controller
{
    public function index(Request $request)
    {
        $folderId = $request->get('folder');
        $currentFolder = null;

        // Sprawdź czy folder istnieje
        if ($folderId) {
            $currentFolder = Media::where('id', $folderId)
                ->where('is_folder', true)
                ->firstOrFail();
        }

        // Pobierz zawartość folderu (foldery i pliki) - w adminie pokazuj wszystkie
        $items = Media::with(['uploadedBy', 'blockedBy'])
            ->inFolder($folderId)
            ->orderBy('is_folder', 'desc') // Foldery na górze
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(50);

        // Breadcrumb navigation
        $breadcrumb = [];
        if ($currentFolder) {
            $breadcrumb = $currentFolder->getBreadcrumb();
            $breadcrumb[] = $currentFolder;
        }

        return view('admin.media.index', compact('items', 'currentFolder', 'breadcrumb'));
    }

    public function store(Request $request)
    {
        // Upload pliku
        if ($request->hasFile('file')) {
            return $this->handleFileUpload($request);
        }

        // Tworzenie folderu
        if ($request->has('folder_name')) {
            return $this->createFolder($request);
        }

        return response()->json(['error' => 'Brak danych do przetworzenia'], 400);
    }

    protected function handleFileUpload(Request $request)
    {
        // Zwiększ limity PHP dla uploadu plików
        ini_set('upload_max_filesize', '2G');
        ini_set('post_max_size', '2G');
        ini_set('max_execution_time', 0); // Bez limitu
        ini_set('max_input_time', 0); // Bez limitu na input
        ini_set('memory_limit', '2G');

        // Ustaw timeout dla Laravel
        set_time_limit(0); // Bez limitu

        $request->validate([
            'file' => [
                'required',
                'file',
                'max:2097152', // 2GB max
                function ($attribute, $value, $fail) {
                    // Szybka walidacja tylko po rozszerzeniu (bez skanowania MIME)
                    $allowedExtensions = [
                        'jpg', 'jpeg', 'png', 'gif', 'webp', 'svg',
                        'pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx',
                        'txt', 'csv',
                        'mp3', 'wav', 'ogg',
                        'mp4', 'avi', 'mov', 'webm',
                        'zip', 'rar', '7z'
                    ];

                    $extension = strtolower($value->getClientOriginalExtension());
                    if (!in_array($extension, $allowedExtensions)) {
                        $fail('Rozszerzenie pliku nie jest dozwolone.');
                    }
                },
            ],
            'folder_id' => 'nullable|exists:media,id',
        ]);

        $file = $request->file('file');
        $folderId = $request->get('folder_id');

        // Sprawdź czy folder istnieje i czy to rzeczywiście folder
        if ($folderId) {
            $folder = Media::where('id', $folderId)->where('is_folder', true)->first();
            if (!$folder) {
                return response()->json(['error' => 'Folder nie istnieje'], 404);
            }
        }

        // Generuj unikalną nazwę pliku
        $extension = $file->getClientOriginalExtension();
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $filename = Str::slug($originalName) . '_' . time() . '.' . $extension;

        // Ścieżka względna dla storage
        $path = 'media/' . date('Y/m/') . $filename;

        // Zapisz plik - sprawdź czy folder jest prywatny
        $isPrivate = false;
        if ($folderId) {
            $folder = Media::find($folderId);
            $isPrivate = $folder && in_array($folder->access_level, ['private', 'authenticated']);
        }

        $disk = $isPrivate ? 'local' : 'public';
        $storedPath = $file->storeAs(dirname($path), basename($path), $disk);

        // Pobierz metadane
        $metadata = $this->extractMetadata($file);

        // Zapisz w bazie danych
        $media = Media::create([
            'name' => $file->getClientOriginalName(),
            'filename' => $filename,
            'path' => $storedPath,
            'disk' => $disk,
            'mime_type' => $file->getMimeType(),
            'size' => $file->getSize(),
            'extension' => $extension,
            'metadata' => $metadata,
            'parent_id' => $folderId,
            'is_folder' => false,
            'uploaded_by' => auth()->id(),
            'is_public' => true,
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'media' => $media->load('uploadedBy'),
                'message' => 'Plik został przesłany pomyślnie'
            ]);
        }

        return redirect()->back()->with('success', 'Plik został przesłany pomyślnie');
    }

    protected function createFolder(Request $request)
    {
        $request->validate([
            'folder_name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:media,id',
        ]);

        $parentId = $request->get('parent_id');

        // Sprawdź czy parent istnieje i czy to folder
        if ($parentId) {
            $parent = Media::where('id', $parentId)->where('is_folder', true)->first();
            if (!$parent) {
                return response()->json(['error' => 'Folder nadrzędny nie istnieje'], 404);
            }
        }

        // Sprawdź czy folder o tej nazwie już istnieje w tym miejscu
        $exists = Media::where('name', $request->folder_name)
            ->where('parent_id', $parentId)
            ->where('is_folder', true)
            ->exists();

        if ($exists) {
            return response()->json(['error' => 'Folder o tej nazwie już istnieje'], 422);
        }

        $folder = Media::create([
            'name' => $request->folder_name,
            'filename' => '',
            'path' => '',
            'disk' => 'public',
            'mime_type' => 'folder',
            'size' => 0,
            'extension' => '',
            'metadata' => [],
            'parent_id' => $parentId,
            'is_folder' => true,
            'uploaded_by' => auth()->id(),
            'is_public' => true,
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'folder' => $folder->load('uploadedBy'),
                'message' => 'Folder został utworzony pomyślnie'
            ]);
        }

        return redirect()->back()->with('success', 'Folder został utworzony pomyślnie');
    }

    public function show(Media $media)
    {
        if ($media->is_folder) {
            // Przekieruj do widoku folderu
            return redirect()->route('admin.media.index', ['folder' => $media->id]);
        }

        return view('admin.media.show', compact('media'));
    }

    public function edit(Media $media)
    {
        return view('admin.media.edit', compact('media'));
    }

    public function update(Request $request, Media $media)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_public' => 'boolean',
        ];

        if ($media->is_folder) {
            // Sprawdź czy folder o tej nazwie już istnieje w tym miejscu
            $rules['name'] = [
                'required',
                'string',
                'max:255',
                Rule::unique('media')->where(function ($query) use ($media) {
                    return $query->where('parent_id', $media->parent_id)
                        ->where('is_folder', true)
                        ->where('id', '!=', $media->id);
                }),
            ];
        }

        $request->validate($rules);

        $media->update([
            'name' => $request->name,
            'description' => $request->description,
            'is_public' => $request->boolean('is_public', true),
        ]);

        return redirect()->back()->with('success', 'Zaktualizowano pomyślnie');
    }

    public function destroy(Media $media)
    {
        if ($media->is_folder && $media->children()->count() > 0) {
            return response()->json(['error' => 'Nie można usunąć folderu, który zawiera pliki'], 422);
        }

        $media->delete();

        return response()->json(['success' => true, 'message' => 'Usunięto pomyślnie']);
    }

    // Metoda do pobierania zawartości folderu przez AJAX
    public function getFolderContents(Request $request)
    {
        $folderId = $request->get('folder_id');

        $items = Media::with(['uploadedBy'])
            ->inFolder($folderId)
            ->orderBy('is_folder', 'desc')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return response()->json($items);
    }

    // Download pliku
    public function download(Media $media)
    {
        if ($media->is_folder) {
            abort(404);
        }

        // Sprawdź uprawnienia
        if (!$media->hasPermission(auth()->user(), 'download')) {
            abort(404); // 404 zamiast 403 dla bezpieczeństwa
        }

        $path = Storage::disk($media->disk)->path($media->path);

        if (!Storage::disk($media->disk)->exists($media->path)) {
            abort(404);
        }

        return response()->download($path, $media->name);
    }

    // Blokowanie/odblokowywanie
    public function block(Request $request, Media $media)
    {
        $request->validate([
            'reason' => 'nullable|string|max:500',
        ]);

        $media->block(auth()->user(), $request->reason);

        return response()->json([
            'success' => true,
            'message' => ($media->is_folder ? 'Folder' : 'Plik') . ' został zablokowany'
        ]);
    }

    public function unblock(Media $media)
    {
        $media->unblock();

        return response()->json([
            'success' => true,
            'message' => ($media->is_folder ? 'Folder' : 'Plik') . ' został odblokowany'
        ]);
    }

    // Zarządzanie uprawnieniami
    public function updateAccess(Request $request, Media $media)
    {
        $request->validate([
            'access_level' => 'required|in:public,authenticated,private,blocked',
        ]);

        $media->update([
            'access_level' => $request->access_level,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Poziom dostępu został zaktualizowany'
        ]);
    }

    // Przypisywanie użytkowników
    public function assignUser(Request $request, Media $media)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'permission' => 'required|in:view,download,edit,admin',
            'expires_hours' => 'nullable|integer|min:1|max:8760', // max 1 rok
        ]);

        $expiresAt = $request->expires_hours ?
            now()->addHours($request->expires_hours) : null;

        $media->authorizedUsers()->syncWithoutDetaching([
            $request->user_id => [
                'permission' => $request->permission,
                'granted_at' => now(),
                'granted_by' => auth()->id(),
                'expires_at' => $expiresAt,
            ]
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Użytkownik został przypisany'
        ]);
    }

    // Usuwanie użytkownika
    public function removeUser(Request $request, Media $media)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $media->authorizedUsers()->detach($request->user_id);

        return response()->json([
            'success' => true,
            'message' => 'Dostęp użytkownika został usunięty'
        ]);
    }

    // Generowanie linku z tokenem
    public function generateAccessLink(Request $request, Media $media)
    {
        $request->validate([
            'expires_hours' => 'nullable|integer|min:1|max:168', // max tydzień
        ]);

        $token = $media->generateAccessToken($request->expires_hours);
        $link = $media->getUrl() . '?token=' . $token;

        return response()->json([
            'success' => true,
            'token' => $token,
            'link' => $link,
            'expires_at' => $media->token_expires_at?->format('Y-m-d H:i:s'),
            'message' => 'Link dostępu został wygenerowany'
        ]);
    }

    // Usuwanie linku z tokenem
    public function revokeAccessLink(Media $media)
    {
        $media->revokeAccessToken();

        return response()->json([
            'success' => true,
            'message' => 'Link dostępu został usunięty'
        ]);
    }

    // Publiczne metody dostępu do plików
    public function publicShow(Media $media)
    {
        // Sprawdź uprawnienia
        if (!$media->canBeAccessedBy(auth()->user())) {
            abort(404); // 404 zamiast 403 dla bezpieczeństwa
        }

        if ($media->is_folder) {
            abort(404);
        }

        // Dla obrazów i PDF - pokaż bezpośrednio
        if ($media->isImage() || $media->extension === 'pdf') {
            return $this->serveBinaryFile($media);
        }

        // Dla innych plików - zwróć informacje
        return view('media.show', compact('media'));
    }

    public function publicDownload(Media $media)
    {
        // Sprawdź uprawnienia
        if (!$media->canBeAccessedBy(auth()->user())) {
            abort(404); // 404 zamiast 403 dla bezpieczeństwa
        }

        if ($media->is_folder) {
            abort(404);
        }

        // Sprawdź konkretne uprawnienie do pobierania
        if (!$media->hasPermission(auth()->user(), 'download')) {
            abort(404);
        }

        return $this->serveBinaryFile($media, true);
    }

    // Serwowanie pliku binarnego
    private function serveBinaryFile(Media $media, bool $asDownload = false)
    {
        if (!Storage::disk($media->disk)->exists($media->path)) {
            abort(404);
        }

        $path = Storage::disk($media->disk)->path($media->path);

        if ($asDownload) {
            return response()->download($path, $media->name);
        }

        return response()->file($path, [
            'Content-Type' => $media->mime_type,
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }

    // Prywatna metoda do wyciągania metadanych z pliku
    private function extractMetadata($file): array
    {
        $metadata = [];

        // Dla obrazów - pobierz wymiary
        if (Str::startsWith($file->getMimeType(), 'image/')) {
            try {
                $imageSize = getimagesize($file->getPathname());
                if ($imageSize) {
                    $metadata['width'] = $imageSize[0];
                    $metadata['height'] = $imageSize[1];
                }
            } catch (\Exception $e) {
                // Ignoruj błędy
            }
        }

        return $metadata;
    }
}
