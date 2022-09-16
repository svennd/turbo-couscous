<h1>TryCron</h1>

<table class="table">
    <tr>
        <th>server</th>
        <th>name</th>
        <th>size (TB)</th>
        <th>free (TB)</th>
        <th>updated</th>
        <th>used</th>
    <tr>
<?php foreach($zfs as $z):
    $size = round($z['size']/(1024*1024*1024*1024), 2);
    $free = round($z['free']/(1024*1024*1024*1024), 2);
    $proc = round((($size-$free)/$size)*100, 2); # procent used
    ?>
    <tr>
        <td><a href="<?php echo base_url('home/brick/' . $z['id']); ?>"><?php echo $z['server']; ?></a></td>
        <td><?php echo $z['name']; ?></td>
        <td><?php echo $size; ?></td>
        <td><?php echo $free; ?></td>
        <td><?php echo $z['updated_at']; ?></td>
        <td>
<div class="progress">
  <div class="progress-bar progress-bar-striped progress-bar-animated <?php echo ($proc > 50) ? (($proc > 80) ? 'bg-danger' : 'bg-warning'): 'bg-success' ; ?>" role="progressbar" aria-label="Animated striped example" aria-valuenow="<?php echo $proc; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $proc; ?>%"><?php echo $proc; ?>%</div>
</div>
        </td>
    <tr>
<?php endforeach; ?>
</table>