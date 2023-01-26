<?php

?>
<div class="panel panel-primary">
<div class="panel-heading"><h3>About</h3></div>
<div class="panel-body">
<div class='row'>
<div class='col-md-8 col-lg-8 col-xl-8'>
<table class='table table-bordered table-sm'>
<tr><td>Code Website</td></td><td><a href='<?php echo settings::get_codewebsite_url(); ?>' target='_blank'><?php echo settings::get_codewebsite_url(); ?></a></td></tr>
<tr><td>App Version</td><td><?php echo settings::get_version(); ?></td></tr>
<tr><td>Webserver Version</td><td><?php echo \IGBIllinois\Helper\functions::get_webserver_version(); ?></td></tr>
<tr><td>MySQL Version</td><td><?php echo $sqlDataBase->getAttribute(\PDO::ATTR_SERVER_VERSION); ?></td>
<tr><td>PHP Version</td><td><?php echo phpversion(); ?></td></tr>
<tr><td>PHP Extensions</td><td><?php 
$extensions_string = "";
foreach (\IGBIllinois\Helper\functions::get_php_extensions() as $row) {
	$extensions_string .= implode(", ",$row) . "<br>";
}
echo $extensions_string;
 ?></td></tr>

</table>

<table class='table table-bordered table-sm'>
	<thead>
		<tr><th>Setting</th><th>Value</th></tr>
	</thead>
	<tbody>
		<tr><td>DEBUG</td><td><?php echo settings::get_debug(); ?></td></tr>
		<tr><td>TITLE</td><td><?php echo settings::get_title(); ?></td></tr>
		<tr><td>EMAIL</td><td><?php echo settings::get_email(); ?></td></tr>
		<tr><td>TIMEZONE</td><td><?php echo settings::get_timezone(); ?></td></tr>
		<tr><td>UPLOAD_DIR</td><td><?php echo settings::get_upload_dir(); ?></td></tr>
		<tr><td>DEFAULT_QUESTION_POINTS</td><td><?php echo settings::get_default_question_points(); ?></td></tr>
		<tr><td>DEFAULT_PASS_SCORE</td><td><?php echo settings::get_default_pass_score(); ?></td></tr>
		<tr><td>LDAP_HOST</td><td><?php echo settings::get_ldap_host(); ?></td></tr>
		<tr><td>LDAP_BASE_DN</td><td><?php echo settings::get_ldap_base_dn(); ?></td></tr>
		<tr><td>LDAP_SSL</td><td><?php if (settings::get_ldap_ssl()) { echo "TRUE"; } else { echo "FALSE"; } ?></td></tr>
		<tr><td>LDAP_TLS</td><td><?php if (settings::get_ldap_tls()) { echo "TRUE"; } else { echo "FALSE"; } ?></td></tr>
		<tr><td>LDAP_PORT</td><td><?php echo settings::get_ldap_port(); ?></td></tr>
		<tr><td>MYSQL_HOST</td><td><?php echo settings::get_mysql_host(); ?></td></tr>
		<tr><td>MYSQL_PORT</td><td><?php echo settings::get_mysql_port(); ?></td></tr>
		<tr><td>MYSQL_DATABASE</td><td><?php echo settings::get_mysql_database(); ?></td></tr>
		<tr><td>MYSQL_SSL</td><td><?php if (settings::get_mysql_ssl()) { echo "TRUE"; } else { echo "FALSE"; }  ?></td></tr>
		<tr><td>MYSQL_USER</td><td><?php echo settings::get_mysql_user(); ?></td></tr>	
	</tbody>
	</table>

</div>
</div>

