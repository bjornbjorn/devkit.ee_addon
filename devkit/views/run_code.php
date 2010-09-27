<p><?=lang('runcode_expl');?></p>
<p><h3><?=lang('enter_code')?></h3></p>

<?=form_open($_form_base.AMP.'&method=run_code');?>

<p><textarea name="code" style="width:100%" cols="10" rows="10"></textarea></p>

<p><input type="submit" class="submit" value="Run code"/></p>

</form>