@php
    use App\Helpers\DataStructures\ProjectActivitiesEnum;
    use App\Helpers\DataStructures\TaskStatusEnum;
    use App\Helpers\DataStructures\EntitiesEnum;
    use App\Models\File;use App\Models\Log;
    use App\Models\Project;use App\Models\Task;use App\Models\Team;use App\Models\User;
@endphp

@extends('layouts.base')

@section('content')

    <div class="row small-margin">
        <h1 class="col display-3 fw-bolder"><span class="text-gradient d-inline">{{ EntitiesEnum::from($entityType)->toString() }} documentation</span>
        </h1>

        <form id="uploadForm" action="{{ route('upload') }}" method="POST" enctype="multipart/form-data"
              style="display:none;">
            @csrf
            <input type="file" name="file" id="fileInput" accept="application/pdf" onchange="uploadFile(this)">
        </form>
        <a id="uploadButton"
           class="col col-lg-3 btn btn-primary fw-bolder small-margin d-flex align-items-center justify-content-center"
           onclick="document.getElementById('fileInput').click();">upload new document</a>
    </div>

    <div class="scrollable_all">

        @foreach (File::where('entity_type', $entityType)->where('entity_id', $entityId)->get() as $file)
            <div>
                <span>{{ $file->file_name }}</span>
                <a href="{{ route('download', ['file_id' => $file->id]) }}" target="_blank">Download</a>
                <a href="{{ route('previewPdf', ['file_id' => $file->id]) }}" >Preview</a>
            </div>
        @endforeach
    </div>

    <script>
        function uploadFile(input) {
            const file = input.files[0];
            if (!file) return;

            const formData = new FormData();
            formData.append('file', file);
            formData.append('entity_type', {{EntitiesEnum::Project}});
            formData.append('entity_id', {{$entityId}});

            fetch('/upload', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: formData,
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log('File uploaded successfully:', data);
                    } else {
                        console.error('Failed to upload file:', data.message);
                    }
                })
                .catch(error => {
                    console.error('There was an error uploading the file:', error);
                });
        }
    </script>

@endsection
