 <!-- sidebar  -->
 <!-- sidebar part here -->
 <nav class="sidebar">
     <div class="logo d-flex justify-content-between">
         <a href="index.html"><img src="/assets/img/logo.png" alt=""></a>
         <div class="sidebar_close_icon d-lg-none">
             <i class="ti-close"></i>
         </div>
     </div>
     <ul id="sidebar_menu">
         <li class="{{ request()->routeIs('home') ? 'mm-active' : '' }}">
             <a class="" href="{{ route('home1') }}" aria-expanded="false">
                 <!-- <i class="fas fa-th"></i> -->
                 <i class="fas fa-home fa-lg"></i>
                 <span>Dashboard</span>
             </a>
         </li>
         @if (Auth()->user()->isAdmin == 0)
             <li class="="{{ request()->routeIs('user.index') ? 'mm-active' : '' }}">
                 <a class="" href="{{ route('user.index') }}" aria-expanded="false">
                     <!-- <i class="fas fa-th"></i> -->
                     <i class="fas fa-user fa-lg"></i>
                     <span>Data Admin</span>
                 </a>
             </li>
             <li
                 class="{{ request()->routeIs('member.report*') || request()->routeIs('transactions.report*') ? 'mm-active' : '' }}">
                 <a class="has-arrow" href="#" aria-expanded="false">
                     <img src="/assets/img/menu-icon/8.svg" alt="">
                     <span>Laporan</span>
                 </a>
                 <ul>
                     <li><a href="{{ route('member.report') }}"
                             class="{{ request()->routeIs('member.report') ? 'active' : '' }}">Pelanggan</a></li>
                     <li><a href="{{ route('transactions.report') }}"
                             class="{{ request()->routeIs('transactions.report') ? 'active' : '' }}">Transaksi</a></li>
                 </ul>
             </li>
         @else
             <li class="{{ request()->routeIs('member.index') ? 'mm-active' : '' }}">
                 <a class="" href="{{ route('member.index') }}" aria-expanded="false">
                     <!-- <i class="fas fa-th"></i> -->
                     <i class="fas fa-users fa-lg"></i>
                     <span>Data Pelanggan</span>
                 </a>
             </li>

             <li
                 class="{{ request()->routeIs('category*') || request()->routeIs('product*') || request()->routeIs('service*') ? 'mm-active' : '' }}">
                 <a class="has-arrow" href="#" aria-expanded="false">
                     <i class="fas fa-warehouse fa-lg"></i>
                     <span>Master Data</span>
                 </a>
                 <ul>
                     <li><a href="{{ route('category.index') }}"
                             class="{{ request()->routeIs('category.index') ? 'active' : '' }}">Kategori</a></li>
                     <li><a href="{{ route('product.index') }}"
                             class="{{ request()->routeIs('product.index') ? 'active' : '' }}">Produk</a></li>
                     <li><a href="{{ route('service.index') }}"
                             class="{{ request()->routeIs('service.index') ? 'active' : '' }}">Service</a></li>
                 </ul>
             </li>
             <li class="{{ request()->routeIs('booking*') ? 'mm-active' : '' }}">
                 <a class="has-arrow" href="#" aria-expanded="false">
                     <i class="fab fa-magento"></i>
                     <span>Data Booking Online</span>
                 </a>
                 <ul>
                     <li><a href="{{ route('booking.confirmation') }}"
                             class="{{ request()->routeIs('booking.confirmation') ? 'active' : '' }}">Konfirmasi</a>
                     </li>
                     <li><a href="{{ route('booking.process') }}"
                             class="{{ request()->routeIs('booking.process') ? 'active' : '' }}">Dalam Pengerjaan</a>
                     </li>
                     <li><a href="{{ route('booking.end') }}"
                             class="{{ request()->routeIs('booking.end') ? 'active' : '' }}">Selesai</a></li>
                     <li><a href="{{ route('booking.cancel') }}"
                             class="{{ request()->routeIs('booking.cancel') ? 'active' : '' }}">Dibatalkan</a></li>
                 </ul>
             </li>
             <li
                 class="{{ request()->routeIs('transaction.index') || request()->routeIs('transaction.history') ? 'mm-active' : '' }}">
                 <a class="has-arrow" href="#" aria-expanded="false">
                     <!-- <i class="fas fa-th"></i> -->
                     <i class="fas fa-chart-bar fa-lg"></i>
                     <span>Transaksi</span>
                 </a>
                 <ul>
                     <li><a href="{{ route('transaction.index') }}"
                             class="{{ request()->routeIs('transaction.index') ? 'active' : '' }}">Kasir</a></li>
                     <li><a href="{{ route('transaction.history') }}"
                             class="{{ request()->routeIs('transaction.history') ? 'active' : '' }}">Riwayat</a></li>

                 </ul>
             </li>
         @endif
     </ul>

 </nav>
 <!-- sidebar part end -->
 <!--/ sidebar  -->
