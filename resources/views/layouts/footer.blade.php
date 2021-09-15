
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script>$("#toggle-menu").on('click', function(){let toggle = document.querySelector('.toggle');let navigation = document.querySelector('.navigation');let main = document.querySelector('.main');toggle.classList.toggle('active');navigation.classList.toggle('active');main.classList.toggle('active');});</script>
@yield('script-footer')
</html>