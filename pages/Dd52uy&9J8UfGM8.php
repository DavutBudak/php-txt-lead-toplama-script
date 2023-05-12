<?php


  $AUTH_USER = 'ornekkullanici';
  $AUTH_PASS = 'orneksifre';

if (isset($_POST['logout'])) {
$AUTH_USER = $AUTH_PASS  = '';
} 


  header('Cache-Control: no-cache, must-revalidate, max-age=0');
  $has_supplied_credentials = !(empty($_SERVER['PHP_AUTH_USER']) && empty($_SERVER['PHP_AUTH_PW']));
  $is_not_authenticated = (
    !$has_supplied_credentials ||
    $_SERVER['PHP_AUTH_USER'] != $AUTH_USER ||
    $_SERVER['PHP_AUTH_PW']   != $AUTH_PASS
  );
  if ($is_not_authenticated) {
    header('HTTP/1.1 401 Authorization Required');
    header('WWW-Authenticate: Basic realm="Access denied"');
    exit;
  }


if (isset($_POST['clear'])) {
  file_put_contents('yazilar.txt', '');
}


?><!DOCTYPE html>
<html lang="en">
<head>
  <title>Lead Tablosu<?php echo date('Y-m-d'); ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
  
 <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
 <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">

<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
  
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
  
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
  
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
  
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
  
  
  
</head>
<body>

<div class="container">
  <form method="POST">
<button name="logout" type="submit">Log Out</button>
</form>

<table style="width: 100%;" class="table col-md-12" id="myTable">
    
     <form method="POST">
<button name="clear" style="margin: auto;display: block;" type="submit"  onclick="return confirm('Gerçekten silmek mi istiyorsun ? geri alınamaz!')">Listeyi Temizle</button>
</form>

    <table id="example" class="display nowrap" style="width:100%">
        <thead>
            <tr>
             <th>#</th>
<th>Tarih</th>
<th>Adı Soyadı</th>
<th>Telefon</th>

            </tr>
        </thead>
        <tbody>
<?php
	
	$file = @file("yazilar.txt"); 
for ($i = 0; $i < count($file); $i++) { 
    if(!empty(trim(ltrim(rtrim(explode('- Telefon:',explode('Adı Soyadı:',$file[$i])[1])[0]))))){
        
        
        if(isset($asd[explode('- Mail: ',explode('Telefon:',$file[$i])[1])[0]])) {  continue; }
        
        $asd[explode('- Mail: ',explode('Telefon:',$file[$i])[1])[0]] = true;
        
        
        
    echo '<tr>
    <td>'.($i + 1).'</td>
    <td>'.explode('- Adı Soyadı: ',explode('TARİH :',$file[$i])[1])[0].'</td>
    <td>'.explode('- Telefon:',explode('Adı Soyadı:',$file[$i])[1])[0].'</td>
    <td>'.explode('- Mail: ',explode('Telefon:',$file[$i])[1])[0].'</td>
  
  </tr>'; }
}  
	
	?>
  </tbody>
    </table>
</div>
<script>
    $(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
</script>
</body>
</html>