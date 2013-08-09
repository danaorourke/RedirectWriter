<form action="<?php echo $SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
	<fieldset id="xml">
		<legend>XML</legend>
		
		<ul>
			<li>
				<label for="export"<?php $this->displayError('export'); ?>>Upload your WordPress export</label>
				<input type="hidden" name="MAX_FILE_SIZE" value="30000" />
				<input type="file" name="export" id="export" value="">
			</li>
			<li>
				<p<?php $this->displayError('origin'); ?>>This was generated from the:</p>
				<ul>
					<li><input type="radio" value="old" name="origin" id="origin_old"<?php $this->formStick('origin', 'old');?>><label for="origin_old">Old Site</label></li>
					<li><input type="radio" value="intermediary" name="origin" id="origin_intermediary"<?php $this->formStick('origin', 'intermediary');?>><label for="origin_intermediary">Intermediate</label></li>
					<li><input type="radio" value="new" name="origin" id="origin_new"<?php $this->formStick('origin', 'new');?>><label for="origin_new">New Site</label></li>
				</ul>
			</li>
		</ul>
	</fieldset>
	<fieldset id="permalinks">
		<legend>Permalink Info</legend>
		
		<ul>
			<li>
				<label for="structure_old"<?php $this->displayError('structure_old'); ?>>Old Permalink Structure <a href="https://codex.wordpress.org/Using_Permalinks" title="Need help with permalinks?" id="permalink_help">Need help with permalinks?</a> </label>
				<input type="text" placeholder="/%category%/%postname%/" id="structure_old" name="structure_old" value="<?php $this->formStick('structure_old'); ?>">
			</li>
			<li>
				<label for="structure_new"<?php $this->displayError('structure_new'); ?>>New Permalink Structure</label>
				<input type="text" placeholder="/%category%/%postname%/" id="structure_new" name="structure_new" value="<?php $this->formStick('structure_new'); ?>">
			</li>
			<li>
				<label for="site_url"<?php $this->displayError('site_url'); ?>>New Site Base URL</label>
				<input type="text" placeholder="http://url.com/" id="site_url" name="site_url" value="<?php $this->formStick('site_url');?>">
			</li>
		</ul>
	</fieldset>
	<fieldset id="options">
		<legend>Options</legend>
		
		<ul>
			<li id="type">
				<p<?php $this->displayError('redirect_type'); ?>>Redirect type:</p>
				<ul>
					<li><input type="radio" value="301" name="redirect_type" id="redirect_301"<?php $this->formStick('redirect_type', '301');?>><label for="redirect_301">301</label></li>
					<li><input type="radio" value="302" name="redirect_type" id="redirect_302"<?php $this->formStick('redirect_type', '302');?><label for="redirect_302">302</label></li>
				</ul>
			</li>
			<li id="generate">
				<p<?php $this->displayError('generator'); ?>>Redirect generation should be...</p>
				<ul>
					<li>
						<input type="radio" value="file" name="generator" id="generator_file"<?php $this->formStick('generator','file');?>>
						<label for="generator_file">Make me a file and download it to my computer.</label>
					</li>
					<li>
						<input type="radio" value="echo" name="generator" id="generator_echo"<?php $this->formStick('generator','echo');?>>
						<label for="generator_echo">Don't you dare download anything. Show me the contents so I can copy &amp; paste and make the file myself.</label>
					</li>
				</ul>
			</li>
		</ul>
	</fieldset>
	<button type="submit" name="submit" id="go">Go!</button>
</form>
