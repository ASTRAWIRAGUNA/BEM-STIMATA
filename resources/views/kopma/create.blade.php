@extends('base')
@section('head')
<link rel="icon" href="{{ asset('images/logo/favicon.png') }}" type="image/png">
<title>BEM | Bendahara Page</title>
<link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/@themesberg/flowbite@1.2.0/dist/flowbite.min.css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
<style>
    .font-family-karla { font-family: karla; }
    .bg-sidebar { background: #3d68ff; }
    .cta-btn { color: #3d68ff; }
    .upgrade-btn { background: #1947ee; }
    .upgrade-btn:hover { background: #0038fd; }
    .active-nav-link { background: #1947ee; }
    .nav-item:hover { background: #1947ee; }
    .account-link:hover { background: #3d68ff; }
    button[data-modal-toggle] i.ri-close-line {
    font-size: 1.5rem; /* Increase font size */
    padding: 0.5rem; /* Increase padding */}
</style>
@endsection
@section('body')
<div class="flex">
    @include('partials.sidebarBendahara')

    <div class="relative w-full flex flex-col h-screen overflow-y-hidden">
        @include('partials.headers')

        <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-flow: row-reverse wrap p-6">
                <div class="card border-primary" >
                    <div class="card-body">
                        <h1 class="text-3xl text-black pb-6 text-bold">Tambahkan Penjualan </h1>
            <div class="w-full mt-6">           
                <div class="container">
                  
                        <!-- Tampilkan pesan error -->
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    <form id="penjualanForm" method="POST" action="{{ route('penjualan.store') }} "   class="bg-white shadow-md rounded px-8 py-6">
                        @csrf
                    
                        <div id="items-container">
                            <div class="item-row">
                                <!-- Dropdown untuk memilih item Kopma -->
                                <div class="form-group flex flex-col sm:flex-row sm:justify-between">
                                    <label for="kopma_id[]">Pilih Item Kopma</label>
                                    <select name="kopma_id[]" 
                                    class="mt-1 block w-30 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                                        <option value="" class="text-center" disabled selected>Pilih Item</option>
                                        @foreach($kopmas as $kopma)
                                            <option value="{{ $kopma->id }}" data-price ="{{ $kopma->item_price }}">
                                                {{ $kopma->item_name }} - Rp. {{ number_format($kopma->item_price, 0, ',', '.') }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                    
                                <!-- Input untuk jumlah -->
                                <div class="form-group mt-2 flex flex-col sm:flex-row sm:justify-between">
                                    <label for="quantity[]">Jumlah</label>
                                    <input type="number" name="quantity[]" class="mt-1 block w-30 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"  required >
                                </div>
                                
                            </div>
                            <button type="button" id="add-item" class="block  text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3  mt-2 p-2 item-center py-1 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 " type="button" >
                                <i class="ri-add-line mr-3 text-lg"></i> Tambah Item</button>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                            <!-- Input untuk jumlah pembayaran -->
                        <div class="form-group mt-2 flex justify-between">
                            <label for="payment">Jumlah Pembayaran</label>
                            <input type="number" name="payment" id="payment" class="mt-1 block w-30 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                             value="0" min="0" required>
                        </div>
                    
                        <!-- Menampilkan Total Harga dan Kembalian -->
                        <div class="form-group mt-2 flex justify-between">
                            <label>Total Harga</label>
                            <input type="text" id="total_price" class="mt-1 block w-30 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                             value="Rp. 0" disabled>
                        </div>
                    
                        <div class="form-group mt-2 flex justify-between">
                            <label>Kembalian</label>
                            <input type="text" id="change" class="mt-1 block w-30 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                             value="Rp. 0" disabled>
                        </div>
                        </div>
                    
                        
                        
                        <button type="submit" class="btn btn-primary w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3  mt-4 items-center py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Buat Penjualan</button>
                    </form>
                    
                    <script>
                        document.addEventListener('DOMContentLoaded', () => {
    const itemsContainer = document.getElementById('items-container');
    const addItemButton = document.getElementById('add-item');
    const paymentInput = document.getElementById('payment');
    const totalPriceInput = document.getElementById('total_price');
    const changeInput = document.getElementById('change');

    // Fungsi untuk menghitung total harga dan kembalian
    function calculateTotal() {
        let totalPrice = 0;
        const itemRows = document.querySelectorAll('.item-row');

        itemRows.forEach(row => {
            const quantityInput = row.querySelector('input[name="quantity[]"]');
            const kopmaSelect = row.querySelector('select[name="kopma_id[]"]');
            const pricePerUnit = parseInt(kopmaSelect.options[kopmaSelect.selectedIndex]?.getAttribute('data-price')) || 0;
            const quantity = parseInt(quantityInput.value) || 0;

            totalPrice += pricePerUnit * quantity;
        });

        totalPriceInput.value = 'Rp. ' + totalPrice.toLocaleString('id-ID'); // Format Rupiah

        const payment = parseInt(paymentInput.value) || 0;
        const change = payment - totalPrice;

        changeInput.value = 'Rp. ' + change.toLocaleString('id-ID'); // Format Rupiah
    }

    // Tambahkan event listener untuk input perubahan
    itemsContainer.addEventListener('input', (e) => {
        if (e.target.matches('select[name="kopma_id[]"], input[name="quantity[]"]')) {
            calculateTotal();
        }
    });

    paymentInput.addEventListener('input', calculateTotal);

    // Fungsi untuk menambahkan baris item baru
    addItemButton.addEventListener('click', () => {
        const newItemRow = document.createElement('div');
        newItemRow.classList.add('item-row');

        newItemRow.innerHTML = `
            <div class="form-group flex flex-col sm:flex-row sm:justify-between mt-4">
                <label for="kopma_id[]">Pilih Item Kopma</label>
                <select name="kopma_id[]" class="mt-1 block w-30 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                    <option value="" disabled selected>Pilih Item</option>
                    @foreach($kopmas as $kopma)
                        <option value="{{ $kopma->id }}" data-price="{{ $kopma->item_price }}">
                            {{ $kopma->item_name }} - Rp. {{ number_format($kopma->item_price, 0, ',', '.') }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group flex flex-col sm:flex-row sm:justify-between mt-2">
                <label for="quantity[]">Jumlah</label>
                <input type="number" name="quantity[]" class="mt-1 block w-30 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
            </div>

            <button type="button" class="remove-item text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-3 mt-2 py-1">
                Hapus Item
            </button>
        `;

        itemsContainer.appendChild(newItemRow);

        const removeButton = newItemRow.querySelector('.remove-item');
        removeButton.addEventListener('click', () => {
            newItemRow.remove();
            calculateTotal();
        });
    });

    // Hitung total awal
    calculateTotal();
});

                        </script>
                </div>
            </main>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
<script src="https://unpkg.com/@themesberg/flowbite@1.2.0/dist/flowbite.bundle.js"></script>
@endsection