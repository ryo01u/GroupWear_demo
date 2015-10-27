<table>
  <tr>
    <td><?php echo $data_department["Department"]["name"] ; ?></td>
  </tr>
  <tr>
    <td><?php echo $this->Util->getImageTag('department' , $data_department['Department']['id'])  ?></td>
    <td><?php echo $data_department["Department"]["memo"] ; ?></td>
  </tr>
</table>

<?php foreach ($data_group as $row): ?>
<table>
  <tr>
    <td><?php echo $row["Group"]["name"] ; ?></td>
  </tr>
</table>
<?php endforeach; ?>