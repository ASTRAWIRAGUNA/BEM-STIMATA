@extends('base')
@section('head')
<title>Fairus | Admin Page</title>
<link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/@themesberg/flowbite@1.2.0/dist/flowbite.min.css" />
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
                
                <div class="container">
                    <h1>Tambah Pesanan</h1>
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


                    <form id="penjualanForm" method="POST" action="{{ route('penjualan.store') }}">
                        @csrf
                    
                        <div id="items-container">
                            <div class="item-row">
                                <!-- Dropdown untuk memilih item Kopma -->
                                <div class="form-group">
                                    <label for="kopma_id[]">Pilih Item Kopma</label>
                                    <select name="kopma_id[]" class="form-control" required>
                                        <option value="" disabled selected>Pilih FUE</option>
                                        @foreach($kopmas as $kopma)
                                            <option value="{{ $kopma->id }}" data-price="{{ $kopma->item_price }}">
                                                {{ $kopma->item_name }} - Rp. {{ number_format($kopma->item_price, 0, ',', '.') }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                    
                                <!-- Input untuk jumlah -->
                                <div class="form-group">
                                    <label for="quantity[]">Jumlah</label>
                                    <input type="number" name="quantity[]" class="form-control quantity"  required >
                                </div>
                            </div>
                        </div>
                    
                        <!-- Input untuk jumlah pembayaran -->
                        <div class="form-group">
                            <label for="payment">Jumlah Pembayaran</label>
                            <input type="number" name="payment" id="payment" class="form-control" value="0" min="0" required>
                        </div>
                    
                        <!-- Menampilkan Total Harga dan Kembalian -->
                        <div class="form-group">
                            <label>Total Harga</label>
                            <input type="text" id="total_price" class="form-control" value="Rp. 0" disabled>
                        </div>
                    
                        <div class="form-group">
                            <label>Kembalian</label>
                            <input type="text" id="change" class="form-control" value="Rp. 0" disabled>
                        </div>
                    
                        <button type="button" id="add-item" class="btn btn-secondary">Tambah Item</button>
                        <button type="submit" class="btn btn-primary">Buat Pesanan</button>
                    </form>
                    
                    <script>
                        const itemsContainer = document.getElementById('items-container');
                        const addItemButton = document.getElementById('add-item');
                        const paymentInput = document.getElementById('payment');
                        const totalPriceInput = document.getElementById('total_price');
                        const changeInput = document.getElementById('change');
                            // Fungsi untuk menghitung total harga dan kembalian
                        function calculateTotal() {
                            let totalPrice = 0;
                            let payment = parseInt(paymentInput.value);
                            let errorMessages = [];
                            // Iterasi semua item yang dipilih
                            const itemRows = document.querySelectorAll('.item-row');
                            itemRows.forEach(row => {
                                const quantityInput = row.querySelector('.quantity');
                                const kopmaSelect = row.querySelector('select');
                                const pricePerUnit = parseInt(kopmaSelect.options[kopmaSelect.selectedIndex].getAttribute('data-price'));
                                const maxStock = parseInt(kopmaSelect.options[kopmaSelect.selectedIndex].getAttribute('data-stock'));
                                const quantity = parseInt(quantityInput.value);

                                 // Validasi stok barang
                                if (quantity > maxStock) {
                                    errorMessages.push(`Jumlah pesanan untuk item '${kopmaSelect.options[kopmaSelect.selectedIndex].text}' melebihi stok tersedia (${maxStock}).`);
                                    quantityInput.classList.add('border-red-500');
                                } else {
                                    quantityInput.classList.remove('border-red-500');
                                }
                                totalPrice += pricePerUnit * quantity;
                            });
            
                            // Hitung kembalian
                            totalPriceInput.value = 'Rp. ' + totalPrice.toLocaleString('id-ID'); // Format Rupiah
                            const change = payment - totalPrice;
                            changeInput.value = 'Rp. ' + change.toLocaleString('id-ID'); // Format Rupiah
                             // Tampilkan pesan error jika ada
                                const errorContainer = document.getElementById('error-container');
                                errorContainer.innerHTML = '';
                                if (errorMessages.length > 0) {
                                    errorMessages.forEach(message => {
                                        const errorElement = document.createElement('div');
                                        errorElement.classList.add('text-red-500', 'mb-2');
                                        errorElement.innerText = message;
                                        errorContainer.appendChild(errorElement);
                                    });
                                }
                        }
                    
                            // Fungsi untuk menambahkan baris item
                            addItemButton.addEventListener('click', () => {
                                const newItemRow = document.createElement('div');
                                newItemRow.classList.add('item-row');
                        
                                newItemRow.innerHTML = `
                                    <div class="form-group">
                                        <label for="kopma_id[]">Pilih Item Kopma</label>
                                        <select name="kopma_id[]" class="form-control" required>
                                            <option value="" disabled selected>Pilih FUE</option>
                                            @foreach($kopmas as $kopma)
                                                <option value="{{ $kopma->id }}" 
                                                    data-price="{{ $kopma->item_price }}" 
                                                    data-stock="{{ $kopma->quantity }}">
                                                    {{ $kopma->item_name }} - Rp. {{ number_format($kopma->item_price, 0, ',', '.') }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                        
                                    <div class="form-group">
                                        <label for="quantity[]">Jumlah</label>
                                        <input type="number" name="quantity[]" class="form-control quantity"  required >
                                    </div>
                                    <button type="button" class="btn btn-danger remove-item" style="margin-top: 30px;">Hapus</button>
                                `;
                        
                                itemsContainer.appendChild(newItemRow);
                                const removeButton = newItemRow.querySelector('.remove-item');
                                removeButton.addEventListener('click', () => {
                                    newItemRow.remove();
                                    calculateTotal(); // Perbarui total jika ada perubahan
                                });
                                
                            });
                            
                            // Validasi sebelum submit form
                                const form = document.querySelector('form');
                                form.addEventListener('submit', (e) => {
                                    calculateTotal();
                                    const hasError = document.querySelector('.border-red-500');
                                    if (hasError) {
                                        e.preventDefault();
                                        alert('Terdapat kesalahan pada pesanan Anda. Silakan perbaiki sebelum mengirimkan.');
                                    }
                                });

                            // Hitung total dan kembalian setiap kali input diubah
                            itemsContainer.addEventListener('input', calculateTotal);
                            paymentInput.addEventListener('input', calculateTotal);
                        
                            // Hitung total awal
                            calculateTotal();
                    </script>
                </div>
            </main>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
<script src="https://unpkg.com/@themesberg/flowbite@1.2.0/dist/flowbite.bundle.js"></script>
@endsection