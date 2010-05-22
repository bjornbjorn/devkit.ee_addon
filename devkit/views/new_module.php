<p>Generate skeleton for a EE 2.0 new module. This tool will automagically create the module installer (<em>upd.yourmodule.php</em>), the control panel file / backend (<em>mcp.yourmodule.php</em>) and the core module file (<em>mod.yourmodule.php</em>)</p>
<p>It's a quick and effective way to kickstart that new module :-)</p>

<?php
echo form_open($_form_base."&method=create_module", '');
?>
<p>
<table class="mainTable" border="0" cellspacing="0" cellpadding="0">
<thead>
<tr>
<th class='translatePhrase'><?=ucfirst(lang('attribute'))?></th><th><?=ucfirst(lang('value'))?></th></tr>
</thead>
<tbody>

<tr class="even">
	<td style='text-align:right;'><label for="module_author">Module Author:</label></td>
	<td><input type="text" name="module_author" id="module_author" value="<?=$this->session->userdata('screen_name');?>" class="fullfield"/></td>
</tr>

<tr class="odd">
	<td style='text-align:right;'><label for="module_name">Module documentation link:</label></td>
	<td><input type="text" name="module_link" id="module_link" value="<?=$this->config->item('site_url');?>" class="fullfield"/></td>
</tr>

			
<tr class="even">
	<td style='text-align:right;'><label for="module_name">Module Name (one word, or use underscores):</label></td>
	<td><input type="text" name="module_name" id="module_name" class="fullfield"/></td>
</tr>

<tr class="odd">
	<td style='text-align:right;'><label for="module_name">Module Human Name:</label></td>
	<td><input type="text" name="module_human_name" id="module_human_name" class="fullfield"/></td>
</tr>

<tr class="even">
	<td style='text-align:right;'><label for="module_name">Module Description:</label></td>
	<td><input type="text" name="module_description" id="module_description" class="fullfield"/></td>
</tr>

<tr class="odd">
	<td style='text-align:right;'><label for="module_name">Has backend?:</label></td>
	<td>
		<select name='has_backend'>
			<option value='y'>Yes</option>
			<option value='n'>No</option>
		</select>
	</td>
</tr>
		
	 
</tbody>
</table>
</p>
<p class="centerSubmit">
	<input type="submit" value="<?=lang('generate_module')?>" class="submit" />	
</p>


</form>

