<p><?php echo lang('yaml2dbforge_expl');?></p>
<p><h3><?php echo lang('enter_yaml')?></h3></p>

<?php echo form_open($_form_base.AMP.'&method=yaml2dbforge');?>

<p><textarea name="yaml" style="width:100%" cols="10" rows="10"><?php 

    if(isset($yaml) && $yaml != '')
    {
        echo $yaml;
    }
    else
    {
        // example yaml
        ?>
User:
  columns:
    username:string(255);
    password:string;
    contact_id:integer;

Contact:
  columns:
    first_name: string(255)
    last_name: string
    phone: string
    email: string
    address: string
<?php 
    }

?></textarea></p>

<p><input type="submit" class="submit" value="Generate code"/></p>

<p><h3>dbforge code (for the upd.yourmodule.com install() function):</h3></p>

<p><textarea name="dbforge" style="width:100%" cols="10" rows="10">
<?php 
    if(isset($parsed_arr))
    {
?>
$this->EE->load->dbforge();
<?php 
        foreach($parsed_arr as $table_name => $table_info)
        {
            $table_name = strtolower($table_name);

            $last_tablename_char = substr($table_name, -1);
            $primary_key = $table_name;
            if($last_tablename_char == 's') // remove plural form (e.g. Members table should have primary key "member_id" not "members_id")
            {
                $primary_key = substr($table_name, 0, strlen($table_name)-1);
            }
            $primary_key .="_id";
            ?>

$<?php echo $table_name?>_fields = array(
<?php 
    foreach($table_info['columns'] as $column_name => $column_type)
    {
        if($column_type == 'pk')
        {
            $primary_key = $column_name;
            break;
        }
    }

    echo get_dbforge_col_def($primary_key, "primary");     // add primary key
    foreach($table_info['columns'] as $column_name => $column_type)
    {
        if($column_type != 'pk') {  // added above
            echo get_dbforge_col_def($column_name, $column_type);
        }
    }
?>
);

$this->EE->dbforge->add_field($<?php echo $table_name?>_fields);
$this->EE->dbforge->add_key('<?php echo $primary_key?>', TRUE);
$this->EE->dbforge->create_table('<?php echo $table_name?>');
<?php 
        }
    }
?>
</textarea></p>

<p><h3>Bonus treat: the upd.yourmodule.php uninstall() function!</h3></p>
<p><textarea style="width:100%" cols="10" rows="10">
<?php 
if(isset($parsed_arr))
{
?>
function uninstall()
{
    $this->EE->load->dbforge();

    $this->EE->db->select('module_id');
    $query = $this->EE->db->get_where('modules', array('module_name' => $this->module_name));

    $this->EE->db->where('module_id', $query->row('module_id'));
    $this->EE->db->delete('module_member_groups');

    $this->EE->db->where('module_name', $this->module_name);
    $this->EE->db->delete('modules');

    $this->EE->db->where('class', $this->module_name);
    $this->EE->db->delete('actions');

    $this->EE->db->where('class', $this->module_name.'_mcp');
    $this->EE->db->delete('actions');

<?php 
foreach($parsed_arr as $table_name => $table_info)
{
?>
    $this->EE->dbforge->drop_table('<?php echo strtolower($table_name)?>');
<?php 
}
?>

    return TRUE;
}
<?php 
}
?>
</textarea></p>

<h3>YAML array</h3>
<p>(for debugging, if this doesn't look right something is wrong)</p>
<p><textarea style="width:100%" cols="10" rows="10"><?php if(isset($parsed_arr)){print_r($parsed_arr);}?></textarea></p>

</form>