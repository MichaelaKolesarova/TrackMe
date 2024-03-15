@php
    use App\Helpers\DataStructures\ProjectActivitiesEnum;
    use App\Helpers\DataStructures\TaskStatusEnum;
    use App\Helpers\DataStructures\EntitiesEnum;
    use App\Models\File;use App\Models\Log;
    use App\Models\Project;use App\Models\Task;use App\Models\Team;use App\Models\User;

@endphp

@extends('layouts.base')

@section('content')

    <div class="scrollable_all container">

        <ul
            class="
          nav nav-tabs
          d-flex
          justify-content-between
          align-items-center
          text-dark
          p-3
        "
        >
            <li class="nav-item">
                <a
                    href="#"
                    class="p-1 border rounded-circle"
                    id="prev_page"
                    title="previous page"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                >
                    <i class="bi bi-chevron-left"></i
                    ></a>

                <input
                    type="number"
                    id="current_page"
                    value="1"
                    class="d-inline form-control"
                />

                <a
                    href="#"
                    class="p-1 border rounded-circle"
                    id="next_page"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    title="next page"
                ><i class="bi bi-chevron-right"></i
                    ></a>

                <!-- page 1 of 5 -->
                Page
                <span id="page_num"></span>
                of
                <span id="page_count"></span>
            </li>

            <li class="nav-item">
                <button
                    class="rounded-circle p-2 border-0 btn btn-primary"
                    id="zoom_in"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    title="zoom in"
                >
                    <i class="bi bi-zoom-in"></i>
                </button>

                <button
                    class="rounded-circle p-2 border-0 btn btn-primary"
                    id="zoom_out"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    title="zoom out"
                >
                    <i class="bi bi-zoom-out"></i>
                </button>
            </li>
        </ul>

        <!-- canvas to place the PDF -->
        <canvas
            id="canvas"
            class="
          d-flex
          flex-column
          justify-content-center
          align-items-center
          mx-auto
        "
        >
        </canvas>
    </div>

    <script
        src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB"
        crossorigin="anonymous"
    ></script>
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13"
        crossorigin="anonymous"
    ></script>


    <script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@2.10.377/build/pdf.min.js"></script>
    <script >
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.worker.min.js';
        //const pdf = 'document.pdf';
        const originalPath = '{{File::find($file)->file_path}}';
        const convertedPath = originalPath.replace('public', './storage');
        const pdf = convertedPath;
        //const pdf = './storage/PDF_files/' + 'document.pdf';
        console.log(pdf)

        const pageNum = document.querySelector('#page_num');
        const pageCount = document.querySelector('#page_count');
        const currentPage = document.querySelector('#current_page');
        const previousPage = document.querySelector('#prev_page');
        const nextPage = document.querySelector('#next_page');
        const zoomIn = document.querySelector('#zoom_in');
        const zoomOut = document.querySelector('#zoom_out');

        const initialState = {
            pdfDoc: null,
            currentPage: 1,
            pageCount: 0,
            zoom: 1,
        };

        // Render the page
        const renderPage = () => {
            // load the first page
            initialState.pdfDoc.getPage(initialState.currentPage).then((page) => {
                console.log('page', page);

                const canvas = document.querySelector('#canvas');
                const ctx = canvas.getContext('2d');
                const viewport = page.getViewport({ scale: initialState.zoom });

                canvas.height = viewport.height;
                canvas.width = viewport.width;

                // Render PDF page into canvas context
                const renderCtx = {
                    canvasContext: ctx,
                    viewport: viewport,
                };

                page.render(renderCtx);

                pageNum.textContent = initialState.currentPage;
            });
        };

        // Load the Document
        pdfjsLib
            .getDocument(pdf)
            .promise.then((data) => {
            initialState.pdfDoc = data;
            console.log('pdfDocument', initialState.pdfDoc);

            pageCount.textContent = initialState.pdfDoc.numPages;

            renderPage();
        })
            .catch((err) => {
                alert(err.message);
            });

        const showPrevPage = () => {
            if (initialState.pdfDoc === null || initialState.currentPage <= 1) return;
            initialState.currentPage--;
            // render the current page
            currentPage.value = initialState.currentPage;
            renderPage();
        };

        const showNextPage = () => {
            if (
                initialState.pdfDoc === null ||
                initialState.currentPage >= initialState.pdfDoc._pdfInfo.numPages
            )
                return;

            initialState.currentPage++;
            currentPage.value = initialState.currentPage;
            renderPage();
        };

        // Button Events
        previousPage.addEventListener('click', showPrevPage);
        nextPage.addEventListener('click', showNextPage);

        // Keypress Event
        currentPage.addEventListener('keypress', (event) => {
            if (initialState.pdfDoc === null) return;
            // get the key code
            const keycode = event.keyCode ? event.keyCode : event.which;

            if (keycode === 13) {
                // get the new page number and render it
                let desiredPage = currentPage.valueAsNumber;
                initialState.currentPage = Math.min(
                    Math.max(desiredPage, 1),
                    initialState.pdfDoc._pdfInfo.numPages
                );

                currentPage.value = initialState.currentPage;
                renderPage();
            }
        });

        // Zoom Events
        zoomIn.addEventListener('click', () => {
            if (initialState.pdfDoc === null) return;
            initialState.zoom *= 4 / 3;
            renderPage();
        });

        zoomOut.addEventListener('click', () => {
            if (initialState.pdfDoc === null) return;
            initialState.zoom *= 2 / 3;
            renderPage();
        });

        // Tooltip

        const tooltipTriggerList = [].slice.call(
            document.querySelectorAll('[data-bs-toggle="tooltip"]')
        );
        const tooltipList = tooltipTriggerList.map((tooltipTriggerEl) => {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    </script>

@endsection
