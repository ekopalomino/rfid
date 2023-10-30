<div class="page-sidebar-wrapper">
	<div class="page-sidebar navbar-collapse collapse">
		<ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
			<li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                    <span></span>
                </div>
            </li>
            <li class="nav-item {{ set_active('dashboard.index') }}">
                <a href="{{ route('dashboard.index') }}" class="nav-link">
                    <i class="icon-home"></i>
                    <span class="title">Beranda</span>
                    <span class="selected"></span>
                </a>
            </li>
            @can('Can Access Settings')
            <li class="nav-item {{ set_active(['warehouse.index','location.index','uom-cat.index','uom-val.index','pay-method.index','pay-term.index','delivery-service.index']) }}">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">Konfigurasi Umum</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item {{ set_active(['location.index']) }}">
                        <a href="{{ route('location.index') }}" class="nav-link">
                            <span class="title">Data Lokasi</span>
                        </a>
                    </li>
                    <li class="nav-item {{ set_active(['warehouse.index']) }}">
                        <a href="{{ route('warehouse.index') }}" class="nav-link">
                            <span class="title">Data Departemen</span>
                        </a>
                    </li>
                    <li class="nav-item {{ set_active(['warehouse.index']) }}">
                        <a href="{{ route('warehouse.index') }}" class="nav-link">
                            <span class="title">Data Cabang</span>
                        </a>
                    </li>
                    <li class="nav-item {{ set_active(['delivery-service.index']) }}">
                        <a href="{{ route('delivery-service.index') }}" class="nav-link">
                            <span class="title">Jasa Pengiriman</span>
                        </a>
                    </li>
                    <li class="nav-item {{ set_active(['uom-cat.index','uom-val.index']) }}">
                        <a href="javascript:;" class="nav-link nav-toggle">
                            <span class="title">Satuan Ukur</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li class="nav-item {{ set_active(['uom-cat.index']) }}">
                                <a href="{{ route('uom-cat.index') }}" class="nav-link ">
                                    <span class="title">Kategori</span>
                                </a>
                            </li>
                            <li class="nav-item {{ set_active(['uom-val.index']) }}">
                                <a href="{{ route('uom-val.index') }}" class="nav-link ">
                                    <span class="title">Nilai Konversi</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item {{ set_active(['pay-method.index','pay-term.index']) }}">
                        <a href="javascript:;" class="nav-link nav-toggle">
                            <span class="title">Kategori Pembayaran</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li class="nav-item {{ set_active(['pay-method.index']) }}">
                                <a href="{{ route('pay-method.index') }}" class="nav-link ">
                                    <span class="title">Metode</span>
                                </a>
                            </li>
                            <li class="nav-item {{ set_active(['pay-term.index']) }}">
                                <a href="{{ route('pay-term.index') }}" class="nav-link ">
                                    <span class="title">Jangka Waktu</span>
                                </a>
                            </li>
                        </ul>
                    </li>                                    
                </ul>
            </li>
            @endcan
            @can('Can Access Users')
            <li class="nav-item {{ set_active(['user.index','user.profile','role.index','uker.index','user.log','role.create','role.edit']) }}">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-users"></i>
                    <span class="title">Manajemen User</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item {{ set_active(['user.index','user.profile']) }}">
                        <a href="{{ route('user.index') }}" class="nav-link ">
                            <span class="title">Daftar User</span>
                        </a>
                    </li>
                    <li class="nav-item {{ set_active(['role.index','role.create','role.edit']) }}">
                        <a href="{{ route('role.index') }}" class="nav-link ">
                            <span class="title">Hak Akses</span>
                        </a>
                    </li>
                    <li class="nav-item {{ set_active(['uker.index']) }}">
                        <a href="{{ route('uker.index') }}" class="nav-link ">
                            <span class="title">Unit Kerja</span>
                        </a>
                    </li>
                    <li class="nav-item {{ set_active(['user.log']) }}">
                        <a href="{{ route('user.log') }}" class="nav-link ">
                            <span class="title">Log Aktivitas</span>
                        </a>
                    </li>                                    
                </ul>
            </li>
            @endcan
            @can('Can Access Products')
            <li class="nav-item {{ set_active(['product-cat.index','product.index','product.create','product.edit','product-bom.index','product-bom.create','product.show','product.barcode']) }}">
            	<a href="javascript:;" class="nav-link nav-toggle">
            		<i class="icon-social-dropbox"></i>
            		<span class="title">Master Item</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                	<li class="nav-item {{ set_active(['product.index','product.create','product.edit','product-bom.index','product-bom.create','product.show']) }}">
                		<a href="{{ route('product.index') }}" class="nav-link ">
                            <span class="title">Data Item</span>
                        </a>
                    </li>
                    <li class="nav-item {{ set_active(['product-cat.index']) }}">
                		<a href="{{ route('product-cat.index') }}" class="nav-link ">
                            <span class="title">Kategori Item</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endcan
            @can('Can Access Contact')
            <li class="nav-item {{ set_active(['customer.index','customer.create','customer.edit','customer.show','supplier.index','supplier.create','supplier.edit']) }}">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-user-follow"></i>
                    <span class="title">Kontak</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item {{ set_active(['customer.index','customer.create','customer.edit','customer.show']) }}">
                        <a href="{{ route('customer.index') }}" class="nav-link ">
                            <span class="title">Data Pelanggan</span>
                        </a>
                    </li>
                    <li class="nav-item {{ set_active(['supplier.index','supplier.create','supplier.edit']) }}">
                        <a href="{{ route('supplier.index') }}" class="nav-link ">
                            <span class="title">Data Pemasok</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endcan
            @can('Can Access Sales')
            <li class="nav-item {{ set_active(['sales.index','sales.create','sales.show','sales.barcode','sales.edit']) }}">
            	<a href="javascript:;" class="nav-link nav-toggle">
            		<i class="icon-present"></i>
            		<span class="title">Sales</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                	<li class="nav-item {{ set_active(['sales.index','sales.create','sales.show','sales.edit']) }}">
                		<a href="{{ route('sales.index') }}" class="nav-link ">
                            <span class="title">Sales Orders</span>
                            <span class="badge badge-danger">{{$sales}}</span>
                        </a>
                    </li>
                    <li class="nav-item {{ set_active(['sales.barcode']) }}">
                		<a href="{{ route('sales.barcode') }}" class="nav-link ">
                            <span class="title">Cetak Barcode</span>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="" class="nav-link ">
                            <span class="title">Retur Sales</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endcan
            @can('disable')
            <li class="nav-item {{ set_active(['pos.index']) }}">
                <a href="{{ route('pos.index') }}" class="nav-link">
                    <i class="icon-notebook"></i>
                    <span class="title">Point of Sale</span>
                </a>
            </li>
            @endcan
            @can('Can Access Purchasing')
            <li class="nav-item {{ set_active(['request.create','purchase.index','request.form','purchase.show','request.show']) }}">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-basket-loaded"></i>
                    <span class="title">Purchasing</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item {{ set_active(['purchase.index','request.create','purchase.show','request.show']) }}">
                        <a href="{{ route('purchase.index') }}" class="nav-link">
                            <span class="title">Permintaan Eksternal</span>
                            <span class="badge badge-danger">{{$purchases}}</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endcan
            @can('Can Access Inventories') 
            <li class="nav-item  {{ set_active(['inventory.index','inventory.adjust','receipt.index','receipt.search','receipt.get','receipt.edit','delivery.index','inventory.card','purchase.show'
            ,'delivery.search','delivery.get','transfer.index','add.transfer','deliveryRetur.index','deliveryRetur.search','deliveryRetur.get']) }}">
            	<a href="javascript:;" class="nav-link nav-toggle">
            		<i class="icon-grid"></i>
            		<span class="title">Gudang</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                	<li class="nav-item  {{ set_active(['inventory.index','inventory.card']) }}">
                		<a href="{{ route('inventory.index') }}" class="nav-link ">
                            <span class="title">Stok Produk</span>
                        </a>
                    </li>
                    <li class="nav-item {{ set_active(['inventory.adjust']) }}">
                		<a href="{{ route('inventory.adjust') }}" class="nav-link ">
                            <span class="title">Penyesuaian</span>
                        </a>
                    </li>
                    <li class="nav-item {{ set_active(['receipt.index','receipt.search','receipt.get','receipt.edit']) }}">
                        <a href="{{ route('receipt.index') }}" class="nav-link ">
                            <span class="title">Penerimaan Barang</span>
                            <span class="badge badge-danger">{{$ex_receipt}}</span>
                        </a>
                    </li>
                    <li class="nav-item {{ set_active(['delivery.index','delivery.search','delivery.get']) }}">
                        <a href="{{ route('delivery.index') }}" class="nav-link ">
                            <span class="title">Pengiriman Barang</span>
                            <span class="badge badge-danger">{{$deliveries}}</span>
                        </a>
                    </li>
                    <li class="nav-item {{ set_active(['transfer.index','add.transfer']) }}">
                        <a href="{{ route('transfer.index') }}" class="nav-link ">
                            <span class="title">Transfer Gudang</span>
                            <span class="badge badge-danger">{{$transfers}}</span>
                        </a>
                    </li>
                    <li class="nav-item {{ set_active(['deliveryRetur.index','deliveryRetur.search','deliveryRetur.get']) }}">
                        <a href="{{ route('deliveryRetur.index') }}" class="nav-link ">
                            <span class="title">Barang Retur</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endcan
            @can('Can Access Manufactures')
            <li class="nav-item {{ set_active(['manufacture.index','manufacture.create','manufacture-request.index','manufacture-request.create','manufacture.show']) }}">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-puzzle"></i>
                    <span class="title">Produksi</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item {{ set_active(['manufacture-request.index','manufacture-request.create']) }}">
                        <a href="{{ route('manufacture-request.index') }}" class="nav-link ">
                            <span class="title">Manufacture Request</span>
                            <span class="badge badge-danger">{{$manrequest}}</span>
                        </a>
                    </li>
                    <li class="nav-item {{ set_active(['manufacture.index','manufacture.create','manufacture.show']) }}">
                        <a href="{{ route('manufacture.index') }}" class="nav-link ">
                            <span class="title">Manufacture Orders</span>
                            <span class="badge badge-danger">{{$manorders}}</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endcan
            @can('Can Access Finances')
            <li class="nav-item {{ set_active(['invoice.index','invoice.create','invoice.search','invoice.store','purchaseReceipt.index','purchaseReceipt.search','purchaseReceipt.get','purchaseReceipt.store']) }}">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-calculator"></i>
                    <span class="title">Finance</span> 
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item {{ set_active(['invoice.index','invoice.create','invoice.search','invoice.store']) }}">
                        <a href="{{ route('invoice.index') }}" class="nav-link nav-toggle">
                            <span class="title">Invoice</span>
                            <span class="badge badge-danger">{{$invoices}}</span>
                        </a>
                    </li>
                    <li class="nav-item {{ set_active(['purchaseReceipt.index','purchaseReceipt.search','purchaseReceipt.get','purchaseReceipt.store']) }}">
                        <a href="{{ route('purchaseReceipt.index') }}" class="nav-link nav-toggle">
                            <span class="title">Pembayaran</span>
                            <span class="badge badge-danger">{{$receipts}}</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endcan
            @can('disable')
            <li class="nav-item  ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-notebook"></i>
                    <span class="title">Accounting</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="ui_colors.html" class="nav-link ">
                            <span class="title">General Ledger</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="ui_colors.html" class="nav-link ">
                            <span class="title">Trial Balance</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item  ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-notebook"></i>
                    <span class="title">Employees</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="ui_colors.html" class="nav-link ">
                            <span class="title">Employee List</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="javascript:;" class="nav-link nav-toggle">
                            <span class="title">Employee Request</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li class="nav-item  ">
                                <a href="ui_colors.html" class="nav-link ">
                                    <span class="title">Leave</span>
                                </a>
                            </li>
                            <li class="nav-item  ">
                                <a href="ui_colors.html" class="nav-link ">
                                    <span class="title">Permit</span>
                                </a>
                            </li>
                            <li class="nav-item  ">
                                <a href="ui_colors.html" class="nav-link ">
                                    <span class="title">Attendance</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item  ">
                        <a href="ui_colors.html" class="nav-link ">
                            <span class="title">Payroll</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endcan
            @can('Can Access Report')
            <li class="nav-item {{ set_active(['sale.table','purchase.table','inventory.table','sale-table.view','inventory-table.view','manufacture.table','purchase-table.view',
                'manufacture-table.view']) }}">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-bar-chart"></i>
                    <span class="title">Laporan</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item {{ set_active(['sale.table','sale-table.view']) }}">
                        <a href="{{ route('sale.table') }}" class="nav-link ">
                            <span class="title">Penjualan</span>
                        </a>
                    </li>
                    <li class="nav-item {{ set_active(['inventory.table','inventory-table.view']) }}">
                        <a href="{{ route('inventory.table') }}" class="nav-link ">
                            <span class="title">Stok</span>
                        </a>
                    </li>
                    <li class="nav-item {{ set_active(['purchase.table','purchase-table.view']) }}">
                        <a href="{{ route('purchase.table') }}" class="nav-link ">
                            <span class="title">Pembelian</span>
                        </a>
                    </li>
                    <li class="nav-item {{ set_active(['manufacture.table','manufacture-table.view']) }}">
                        <a href="{{ route('manufacture.table') }}" class="nav-link ">
                            <span class="title">Manufaktur</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endcan
        </ul>
    </div>
</div>