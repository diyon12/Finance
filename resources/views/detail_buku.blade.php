<!DOCTYPE html>
<html>
<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js" integrity="sha512-q+4liFwdPC/bNdhUpZx6aXDx/h77yEQtn4I1slHydcbZK34nLaR3cAeYSJshoxIOq3mjEf7xJE8YWIUHMn+oCQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        /* CSS untuk mengatur tombol ke tengah */
        #button-container {
            text-align: center;
        }
        #main-text{
            text-align: center;
        }
    </style>
</head>
<body>
<div id="main-text">
        <div id="pdf-container"></div>
</div>
<div id="button-container">
    <button id="btnKembali">Kembali</button>
    <button id="btnHalamanSebelumnya">Halaman Sebelumnya</button>
    <button id="btnHalamanSelanjutnya">Halaman Selanjutnya</button>
</div>
    <script>
        var filename = "{{ Storage::url('files/' . $item->file) }}";
        var pdfUrl = filename;
        var currentPage = 1; // Halaman awal yang akan ditampilkan
        var pdfDoc = null;

        function renderPage(pageNum) {
            pdfDoc.getPage(pageNum).then(function(page) {
                var canvas = document.createElement('canvas');
                var context = canvas.getContext('2d');
                var viewport = page.getViewport({ scale: 1.5 });

                canvas.height = viewport.height;
                canvas.width = viewport.width;

                document.getElementById('pdf-container').innerHTML = ''; // Bersihkan kontainer sebelum merender halaman baru.
                document.getElementById('pdf-container').appendChild(canvas);

                page.render({
                    canvasContext: context,
                    viewport: viewport
                });
            });
        }

        pdfjsLib.getDocument(pdfUrl).promise.then(function(pdf) {
            pdfDoc = pdf; // Menetapkan pdfDoc dengan nilai yang benar
            renderPage(currentPage); // Merender halaman pertama saat dokumen sudah diambil
        });

        // Fungsi untuk menampilkan halaman sebelumnya
        document.getElementById('btnHalamanSebelumnya').addEventListener('click', function() {
            if (currentPage > 1) {
                currentPage--;
                renderPage(currentPage);
            }
        });

        // Fungsi untuk menampilkan halaman selanjutnya
        document.getElementById('btnHalamanSelanjutnya').addEventListener('click', function() {
            if (currentPage < pdfDoc.numPages) {
                currentPage++;
                renderPage(currentPage);
            }
        });
    </script>
    <script>
        document.getElementById('btnKembali').addEventListener('click', function() {
            window.history.back();
        });
    </script>
</body>
</html>
