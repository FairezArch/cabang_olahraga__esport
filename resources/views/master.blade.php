@include('layouts.header')
@include('layouts.sidebar')
<div class="main">
   <div class="topbar pt-2 pb-2">
      <div class="toggle" id="toggle-menu"></div>
      <div class="search d-none">
         <div class="user">
            <img 
               src="https://images.unsplash.com/photo-1629753453388-5f3ae10370ef?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=334&q=80" 
               alt="https://images.unsplash.com/photo-1629753453388-5f3ae10370ef?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=334&q=80" 
            />
         </div>
      </div>
   </div>
   <div class="container-fluid pt-4 pb-4">
      @yield('content')
   </div>
   <footer class="w-100 p-2 mr-2 text-center footer">Esport &copy; {{\Carbon\Carbon::now()->year}}</footer>
</div>
@include('layouts.footer')