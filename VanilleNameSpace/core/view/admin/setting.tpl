{% include 'admin/notice/update.tpl' %}
<div class="card">
	<div class="card-body">
		<h3 class="card-title">{{string.settingTitle}}</h3>
		<p class="card-text">{{string.settingDesc}}</p>
		<form class="VanilleNameSpace-setting-form" method="post" action="options.php">
			{{ settings_fields('VanilleNameSpace-option') }}
			{{ do_settings_sections('VanilleNameSpace-option') }}
			<div class="row">
				<div class="col-sm">
					<div class="form-group">
						<label for="VanilleNameSpace-example">{{translate('Example option')}}</label>
						<input id="VanilleNameSpace-example" type="text" class="form-control" name="VanilleNameSpace-example" placeholder="{{translate('Example option here')}}" value="{{ get_option('VanilleNameSpace-example') }}">
					</div>
				</div>
				<div class="col-sm">
					<div class="form-group">
						<label for="placeholder-input">{{translate('Placeholder input')}}</label>
						<div class="placeholder-input"></div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm">
					<div class="form-group">
						<label for="placeholder-input">{{translate('Placeholder input')}}</label>
						<div class="placeholder-input"></div>
					</div>
				</div>
				<div class="col-sm">
					<div class="form-group">
						<label for="placeholder-input">{{translate('Placeholder input')}}</label>
						<div class="placeholder-input"></div>
					</div>
				</div>
			</div>
			<button type="submit" name="submit" id="submit" class="btn btn-primary">{{string.save}}</button>
		</form>
	</div>
</div>