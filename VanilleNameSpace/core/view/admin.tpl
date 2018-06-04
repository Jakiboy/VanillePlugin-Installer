<div class="wrap VanilleNameSpace-admin">
	<ul class="nav nav-tabs nav-justified">
		<li class="nav-item">
			<a class="nav-link active" id="setting-tab" data-toggle="tab" href="#setting" role="tab" aria-controls="setting" aria-expanded="true">{{string.settingTab}}</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" id="about-tab" data-toggle="tab" href="#about" role="tab" aria-controls="about">{{string.aboutTab}}</a>
		</li>
	</ul>
	<div class="tab-content" id="admin-tab">
		<div class="tab-pane fade show active" id="setting" role="tabpanel" aria-labelledby="setting-tab">
			{% include 'admin/setting.tpl' %}
		</div>
		<div class="tab-pane fade" id="about" role="tabpanel" aria-labelledby="about-tab">
			{% include 'admin/about.tpl' %}
		</div>
	</div>
	{% include 'admin/notice/javascript.tpl' %}
</div>