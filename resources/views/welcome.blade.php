<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])



</head>

<body class="antialiased">
    <div
        class="relative flex justify-center items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">


        <div class="max-w-7xl mx-auto p-6 lg:p-8">


            <div class="mt-16">
                <div class="flex flex-row max-w-xl justify-center justify-items-center">
                    <div
                        class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500 ">
                        <div>


                            <h2 class="my-6 text-xl text-center font-semibold text-gray-900 dark:text-dark">barcode
                                generator</h2>
                            <h5
                                class="mb-2 text-2xl text-center font-bold tracking-tight text-gray-900 dark:text-white">
                                ادخل البيانات اللازمة لتوليد الباركود</h5>


                            <form class="max-w-sm mx-auto" style="direction: rtl">
                                <div class="mb-5">
                                    <label for="name"
                                        class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">اسم
                                        المستخدم:</label>
                                    <input type="text"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        id="name" placeholder="أدخل اسم المستخدم">
                                </div>
                                <div class="mb-5">

                                    <label for="category"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">اسم
                                        الصنف:</label>
                                    <input type="text" id="category"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="أدخل اسم الصنف">
                                </div>

                                <div class="mb-5">

                                    <label for="product_price"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"> سعر المنتج
                                        :</label>
                                    <input type="number" id="product_price"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="أدخل  سعر المنتج ">
                                </div>

                                <div class="mb-5">

                                    <label for="data"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">أدخل
                                        رقم
                                        الباركود:</label>
                                    <input type="text"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        id="data" placeholder="أدخل البيانات">
                                </div>



                                <div id="barcode" class="mb-5" ></div>
                                <input type="button" id="print"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                    value="طباعة" onclick="printBarcode()">
                            </form>
                        </div>


                    </div>
                </div>
            </div>


        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.0/dist/JsBarcode.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script>
        document.getElementById('data').addEventListener('input', generateBarcode);

        function generateBarcode() {
            const symbology = 'CODE128';
            const data = document.getElementById('data').value;
            const size = 1;

            document.getElementById('barcode').innerHTML = '';

            if (data.trim() === '') {
                return;
            }


            generate1DBarcode(symbology, data, size);

        }

        function generate1DBarcode(format, data, size) {
            const canvas = document.createElement('canvas');
            JsBarcode(canvas, data, {
                format: format,
                width: 2 * size,
                height: 100 * size,
                displayValue: true
            });
            const barcodeElement = document.getElementById('barcode').appendChild(canvas);

        }



        generateBarcode();

        function printBarcode() {
            const barcodeCanvas = document.querySelector('#barcode canvas');

            if (barcodeCanvas) {
                const barcodeImage = barcodeCanvas.toDataURL();

                const printWindow = window.open('', '', 'width=800,height=600');

                printWindow.document.write(`
            <html>
                <head>
                    <title>طباعة الباركود</title>
                    <style>
                        body { margin: 0; padding: 20px; text-align: center; }
                    </style>
                </head>
                <body>
                    <img src="${barcodeImage}" alt="Barcode">
                </body>
            </html>
        `);

                printWindow.document.close();

                printWindow.onload = function() {
                    printWindow.print();
                };
            } else {
                alert('لا يوجد باركود للطباعة.');
            }
        }
    </script>
</body>

</html>
