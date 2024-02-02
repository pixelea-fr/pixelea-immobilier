<div class="ng1ImmoDebugToggleJs" style='font-weight:bold;display:inline-block;padding:.2em 1em; border-radius:5px; background-color: black; color: white; cursor:pointer'>debug</div>   
<div class='ng1ImmoDebugJs' style='background-color: black; color: white; padding: 30px'>
<h2 style='color: white'>ViewDEBUG</h2>
<?php $available_methods = $bien->getAvailableMethods(); 
 ?>
<table style ='color:white'>
<thead>
    <tr>
        <th align='left'>Method</th>
        <th align='left'>Echo Method</th>
        <th align='left'>Value</th>
</tr>
</thead>
    <tbody>

<?php 
foreach ($available_methods as $method) {
    $method_name=str_replace(array('(',')'),array('',''), $method);
    echo '<tr>';
    echo '<td>{'.Ng1ImmoFormat::getVariableNameFromMethod($method) . '} <br>ng1_filter_'. Ng1ImmoFormat::getPropertyFromMethod($method).'</td>';
    echo '<td>&lt;?php echo ' . $method . '(); ?&gt;</td>';
    if((!in_array($method_name, array('getAvailableMethods','getData')))){


    if(!is_array($bien->$method_name())){
        echo '<td>'.$bien->$method_name(). '</td>';
    }else{
        echo '<td>';
     print_r($bien->$method_name());
        echo '</td>';
    }
}
    echo '</tr>';
    echo '<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>';
}
?>
</tbody>
</table>
</div>
<script>
(function($){
    $(document).ready(function () {
        $('.ng1ImmoDebugJs').hide();
        $('.ng1ImmoDebugToggleJs').on('click', function () {
            $('.ng1ImmoDebugJs').toggle();
        })
    });
})(jQuery);
</script>