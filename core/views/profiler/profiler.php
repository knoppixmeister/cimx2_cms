<div style="clear:both;background-color:#fff;padding:10px;" id="codeigniter_profiler">

	<fieldset style="border:1px solid #900;padding:6px 10px 10px 10px;margin:20px 0 20px 0;background-color:#eee" id="ci_profiler_benchmarks">
		<legend style="color:#900;">&nbsp;&nbsp;BENCHMARKS&nbsp;&nbsp;</legend>

		<table style="width:100%">
		<tbody>
			<tr>
				<td style="padding:5px;width:50%;color:#000;font-weight:bold;background-color:#ddd;">Loading Time: Base Classes&nbsp;&nbsp;</td><td style="padding:5px;width:50%;color:#900;font-weight:normal;background-color:#ddd;">0.4280</td>
			</tr>
				<tr><td style="padding:5px;width:50%;color:#000;font-weight:bold;background-color:#ddd;">Controller Execution Time ( Blog / Index )&nbsp;&nbsp;</td><td style="padding:5px;width:50%;color:#900;font-weight:normal;background-color:#ddd;">0.0962</td></tr>
				<tr><td style="padding:5px;width:50%;color:#000;font-weight:bold;background-color:#ddd;">Total Execution Time&nbsp;&nbsp;</td><td style="padding:5px;width:50%;color:#900;font-weight:normal;background-color:#ddd;">0.5267</td>
			</tr>
		</tbody>
		</table>

	</fieldset>

	<fieldset style="border:1px solid #cd6e00;padding:6px 10px 10px 10px;margin:20px 0 20px 0;background-color:#eee" id="ci_profiler_get">
		<legend style="color:#cd6e00;">&nbsp;&nbsp;GET DATA&nbsp;&nbsp;</legend>

		<table style="width:100%; border:none">
		<tbody>
		<?php
			foreach($_GET as $key => $val) {
		?>
		<tr>
			<td style="width:50%;color:#000;background-color:#ddd;padding:5px">$_GET['<?php e($key)?>']&nbsp;&nbsp;</td>
			<td style="width:50%;padding:5px;color:#cd6e00;font-weight:normal;background-color:#ddd;"><?php e($val)?></td>
		</tr>
		<?php
			}
		?>
		</tbody>
		</table>

	</fieldset>

	<fieldset style="border:1px solid #5a0099;padding:6px 10px 10px 10px;margin:20px 0 20px 0;background-color:#eee" id="ci_profiler_memory_usage">
		<legend style="color:#5a0099;">&nbsp;&nbsp;MEMORY USAGE&nbsp;&nbsp;</legend>

		<div style="color:#5a0099;font-weight:normal;padding:4px 0 4px 0">3,478,040 bytes</div>
	</fieldset>

	<fieldset style="border:1px solid #009900;padding:6px 10px 10px 10px;margin:20px 0 20px 0;background-color:#eee" id="ci_profiler_post">
		<legend style="color:#009900;">&nbsp;&nbsp;POST DATA&nbsp;&nbsp;</legend>

		<?php
			if(count($_POST) == 0) {
		?>
		<div style="color:#009900;font-weight:normal;padding:4px 0 4px 0">No POST data</div>
		<?php
			}
			else {
		?>
		<table style="width:100%; border:none">
		<tbody>
		<?php
			foreach($_POST as $key => $val) {
		?>
		<tr>
			<td style="width:50%;color:#000;background-color:#ddd;padding:5px">$_POST['<?php e($key)?>']&nbsp;&nbsp;</td>
			<td style="width:50%;padding:5px;color:#cd6e00;font-weight:normal;background-color:#ddd;"><?php e($val)?></td>
		</tr>
		<?php
			}
		?>
		</tbody>
		</table>
		<?php
			}
		?>
	</fieldset>

<fieldset style="border:1px solid #000;padding:6px 10px 10px 10px;margin:20px 0 20px 0;background-color:#eee" id="ci_profiler_uri_string">
<legend style="color:#000;">&nbsp;&nbsp;URI STRING&nbsp;&nbsp;</legend>
<div style="color:#000;font-weight:normal;padding:4px 0 4px 0">en/blog</div></fieldset>

<fieldset style="border:1px solid #995300;padding:6px 10px 10px 10px;margin:20px 0 20px 0;background-color:#eee" id="ci_profiler_controller_info">
<legend style="color:#995300;">&nbsp;&nbsp;CLASS/METHOD&nbsp;&nbsp;</legend>
<div style="color:#995300;font-weight:normal;padding:4px 0 4px 0">blog/index</div></fieldset><fieldset style="border:1px solid #0000FF;padding:6px 10px 10px 10px;margin:20px 0 20px 0;background-color:#eee">
<legend style="color:#0000FF;">&nbsp;&nbsp;DATABASE:&nbsp; ci_mx&nbsp;&nbsp;&nbsp;QUERIES: 9&nbsp;&nbsp;(<span onclick="var s=document.getElementById('ci_profiler_queries_db_1').style;s.display=s.display=='none'?'':'none';this.innerHTML=this.innerHTML=='Hide'?'Show':'Hide';" style="cursor: pointer;">Hide</span>)</legend>


<table id="ci_profiler_queries_db_1" style="width:100%;">
<tbody><tr>
										<td style="padding:5px; vertical-align: top;width:1%;color:#900;font-weight:normal;background-color:#ddd;">0.0021&nbsp;&nbsp;</td>
										<td style="padding:5px; color:#000;font-weight:normal;background-color:#ddd;"><code><span style="color: #000000">
<span style="color: #0000BB"><strong>SELECT</strong>&nbsp;</span><span style="color: #007700">*<br></span><span style="color: #0000BB"><strong>FROM</strong>&nbsp;</span><span style="color: #007700"><strong>(</strong>`</span><span style="color: #DD0000">ci_mx2_sessions</span><span style="color: #007700">`<strong>)</strong><br></span><span style="color: #0000BB"><strong>WHERE</strong>&nbsp;</span><span style="color: #007700">`</span><span style="color: #DD0000">session_id</span><span style="color: #007700">`&nbsp;=&nbsp;&nbsp;</span><span style="color: #DD0000">'32a92cc004e01a364fa5c6ac706a1e1c'&nbsp;</span>
</span>
</code></td>
									</tr><tr>
										<td style="padding:5px; vertical-align: top;width:1%;color:#900;font-weight:normal;background-color:#ddd;">0.0011&nbsp;&nbsp;</td>
										<td style="padding:5px; color:#000;font-weight:normal;background-color:#ddd;"><code><span style="color: #000000">
<span style="color: #0000BB">DELETE&nbsp;<strong>FROM</strong>&nbsp;</span><span style="color: #007700">`</span><span style="color: #DD0000">ci_mx2_sessions</span><span style="color: #007700">`<br></span><span style="color: #0000BB"><strong>WHERE</strong>&nbsp;</span><span style="color: #007700">`</span><span style="color: #DD0000">last_activity</span><span style="color: #007700">`&nbsp;&lt;&nbsp;</span><span style="color: #0000BB">1278025984&nbsp;</span>
</span>
</code></td>
									</tr><tr>
										<td style="padding:5px; vertical-align: top;width:1%;color:#900;font-weight:normal;background-color:#ddd;">0.0014&nbsp;&nbsp;</td>
										<td style="padding:5px; color:#000;font-weight:normal;background-color:#ddd;"><code><span style="color: #000000">
<span style="color: #0000BB"><strong>SELECT</strong>&nbsp;</span><span style="color: #007700">*<br></span><span style="color: #0000BB"><strong>FROM</strong>&nbsp;</span><span style="color: #007700"><strong>(</strong>`</span><span style="color: #DD0000">settings</span><span style="color: #007700">`<strong>)</strong>&nbsp;</span>
</span>
</code></td>
									</tr><tr>
										<td style="padding:5px; vertical-align: top;width:1%;color:#900;font-weight:normal;background-color:#ddd;">0.0021&nbsp;&nbsp;</td>
										<td style="padding:5px; color:#000;font-weight:normal;background-color:#ddd;"><code><span style="color: #000000">
<span style="color: #0000BB"><strong>SELECT</strong>&nbsp;</span><span style="color: #007700">*<br></span><span style="color: #0000BB"><strong>FROM</strong>&nbsp;</span><span style="color: #007700"><strong>(</strong>`</span><span style="color: #DD0000">modules</span><span style="color: #007700">`<strong>)</strong>&nbsp;</span>
</span>
</code></td>
									</tr><tr>
										<td style="padding:5px; vertical-align: top;width:1%;color:#900;font-weight:normal;background-color:#ddd;">0.0025&nbsp;&nbsp;</td>
										<td style="padding:5px; color:#000;font-weight:normal;background-color:#ddd;"><code><span style="color: #000000">
<span style="color: #0000BB"><strong>SELECT</strong>&nbsp;</span><span style="color: #007700">*<br></span><span style="color: #0000BB"><strong>FROM</strong>&nbsp;</span><span style="color: #007700"><strong>(</strong>`</span><span style="color: #DD0000">blog_settings</span><span style="color: #007700">`<strong>)</strong>&nbsp;</span>
</span>
</code></td>
									</tr><tr>
										<td style="padding:5px; vertical-align: top;width:1%;color:#900;font-weight:normal;background-color:#ddd;">0.0014&nbsp;&nbsp;</td>
										<td style="padding:5px; color:#000;font-weight:normal;background-color:#ddd;"><code><span style="color: #000000">
<span style="color: #0000BB"><strong>SELECT</strong>&nbsp;</span><span style="color: #007700">`</span><span style="color: #DD0000">tbl</span><span style="color: #007700">`.*,&nbsp;`</span><span style="color: #DD0000">u</span><span style="color: #007700">`.`</span><span style="color: #DD0000">username</span><span style="color: #007700">`&nbsp;<strong>AS</strong>&nbsp;</span><span style="color: #0000BB">created_by_username</span><span style="color: #007700">,&nbsp;`</span><span style="color: #DD0000">bc</span><span style="color: #007700">`.`</span><span style="color: #DD0000">slug</span><span style="color: #007700">`&nbsp;<strong>AS</strong>&nbsp;</span><span style="color: #0000BB">blog_category_slug</span><span style="color: #007700">,&nbsp;<strong>(</strong>
<br>&nbsp;</span><span style="color: #0000BB"><strong>SELECT</strong>&nbsp;t1</span><span style="color: #007700">.</span><span style="color: #0000BB">text&nbsp;
<br>&nbsp;<strong>FROM</strong>&nbsp;_texts&nbsp;t1&nbsp;
<br>&nbsp;<strong>WHERE</strong>&nbsp;t1</span><span style="color: #007700">.</span><span style="color: #0000BB">module</span><span style="color: #007700">=</span><span style="color: #DD0000">'blog_categories'&nbsp;
<br>&nbsp;</span><span style="color: #007700"><strong>AND</strong>&nbsp;</span><span style="color: #0000BB">t1</span><span style="color: #007700">.</span><span style="color: #0000BB">module_record_id</span><span style="color: #007700">=</span><span style="color: #0000BB">bc</span><span style="color: #007700">.</span><span style="color: #0000BB">id&nbsp;
<br>&nbsp;</span><span style="color: #007700"><strong>AND</strong>&nbsp;</span><span style="color: #0000BB">t1</span><span style="color: #007700">.</span><span style="color: #0000BB">language</span><span style="color: #007700">=</span><span style="color: #DD0000">'en'&nbsp;
<br>&nbsp;</span><span style="color: #007700"><strong>AND</strong>&nbsp;</span><span style="color: #0000BB">t1</span><span style="color: #007700">.</span><span style="color: #0000BB">field</span><span style="color: #007700">=</span><span style="color: #DD0000">'title'&nbsp;
<br>&nbsp;</span><span style="color: #007700"><strong>)</strong>&nbsp;<strong>AS</strong>&nbsp;</span><span style="color: #0000BB">blog_category_title</span><span style="color: #007700">,&nbsp;<strong>(</strong></span><span style="color: #0000BB"><strong>SELECT</strong>&nbsp;t1</span><span style="color: #007700">.</span><span style="color: #0000BB">text&nbsp;
<br>&nbsp;<strong>FROM</strong>&nbsp;_texts&nbsp;t1&nbsp;
<br>&nbsp;<strong>WHERE</strong>&nbsp;t1</span><span style="color: #007700">.</span><span style="color: #0000BB">module</span><span style="color: #007700">=</span><span style="color: #DD0000">'blog'&nbsp;
<br>&nbsp;</span><span style="color: #007700"><strong>AND</strong>&nbsp;</span><span style="color: #0000BB">t1</span><span style="color: #007700">.</span><span style="color: #0000BB">module_record_id</span><span style="color: #007700">=</span><span style="color: #0000BB">tbl</span><span style="color: #007700">.</span><span style="color: #0000BB">id&nbsp;
<br>&nbsp;</span><span style="color: #007700"><strong>AND</strong>&nbsp;</span><span style="color: #0000BB">t1</span><span style="color: #007700">.</span><span style="color: #0000BB">language</span><span style="color: #007700">=</span><span style="color: #DD0000">'en'&nbsp;
<br>&nbsp;</span><span style="color: #007700"><strong>AND</strong>&nbsp;</span><span style="color: #0000BB">t1</span><span style="color: #007700">.</span><span style="color: #0000BB">field</span><span style="color: #007700">=</span><span style="color: #DD0000">'title'</span><span style="color: #007700"><strong>)</strong>&nbsp;<strong>AS</strong>&nbsp;</span><span style="color: #0000BB">title_en</span><span style="color: #007700">,&nbsp;<strong>(</strong>&nbsp;
<br>&nbsp;</span><span style="color: #0000BB"><strong>SELECT</strong>&nbsp;t1</span><span style="color: #007700">.</span><span style="color: #0000BB">text&nbsp;
<br>&nbsp;<strong>FROM</strong>&nbsp;_texts&nbsp;t1&nbsp;
<br>&nbsp;<strong>WHERE</strong>&nbsp;t1</span><span style="color: #007700">.</span><span style="color: #0000BB">module</span><span style="color: #007700">=</span><span style="color: #DD0000">'blog'&nbsp;
<br>&nbsp;</span><span style="color: #007700"><strong>AND</strong>&nbsp;</span><span style="color: #0000BB">t1</span><span style="color: #007700">.</span><span style="color: #0000BB">module_record_id</span><span style="color: #007700">=</span><span style="color: #0000BB">tbl</span><span style="color: #007700">.</span><span style="color: #0000BB">id&nbsp;
<br>&nbsp;</span><span style="color: #007700"><strong>AND</strong>&nbsp;</span><span style="color: #0000BB">t1</span><span style="color: #007700">.</span><span style="color: #0000BB">language</span><span style="color: #007700">=</span><span style="color: #DD0000">'en'&nbsp;
<br>&nbsp;</span><span style="color: #007700"><strong>AND</strong>&nbsp;</span><span style="color: #0000BB">t1</span><span style="color: #007700">.</span><span style="color: #0000BB">field</span><span style="color: #007700">=</span><span style="color: #DD0000">'title'&nbsp;
<br>&nbsp;</span><span style="color: #007700"><strong>)</strong>&nbsp;<strong>AS</strong>&nbsp;</span><span style="color: #0000BB">title</span><span style="color: #007700">,&nbsp;<strong>(</strong></span><span style="color: #0000BB"><strong>SELECT</strong>&nbsp;t2</span><span style="color: #007700">.</span><span style="color: #0000BB">text&nbsp;
<br>&nbsp;<strong>FROM</strong>&nbsp;_texts&nbsp;t2&nbsp;
<br>&nbsp;<strong>WHERE</strong>&nbsp;t2</span><span style="color: #007700">.</span><span style="color: #0000BB">module</span><span style="color: #007700">=</span><span style="color: #DD0000">'blog'&nbsp;
<br>&nbsp;</span><span style="color: #007700"><strong>AND</strong>&nbsp;</span><span style="color: #0000BB">t2</span><span style="color: #007700">.</span><span style="color: #0000BB">module_record_id</span><span style="color: #007700">=</span><span style="color: #0000BB">tbl</span><span style="color: #007700">.</span><span style="color: #0000BB">id&nbsp;
<br>&nbsp;</span><span style="color: #007700"><strong>AND</strong>&nbsp;</span><span style="color: #0000BB">t2</span><span style="color: #007700">.</span><span style="color: #0000BB">language</span><span style="color: #007700">=</span><span style="color: #DD0000">'en'&nbsp;
<br>&nbsp;</span><span style="color: #007700"><strong>AND</strong>&nbsp;</span><span style="color: #0000BB">t2</span><span style="color: #007700">.</span><span style="color: #0000BB">field</span><span style="color: #007700">=</span><span style="color: #DD0000">'preview'</span><span style="color: #007700"><strong>)</strong>&nbsp;<strong>AS</strong>&nbsp;</span><span style="color: #0000BB">preview_en</span><span style="color: #007700">,&nbsp;<strong>(</strong>&nbsp;
<br>&nbsp;</span><span style="color: #0000BB"><strong>SELECT</strong>&nbsp;t2</span><span style="color: #007700">.</span><span style="color: #0000BB">text&nbsp;
<br>&nbsp;<strong>FROM</strong>&nbsp;_texts&nbsp;t2&nbsp;
<br>&nbsp;<strong>WHERE</strong>&nbsp;t2</span><span style="color: #007700">.</span><span style="color: #0000BB">module</span><span style="color: #007700">=</span><span style="color: #DD0000">'blog'&nbsp;
<br>&nbsp;</span><span style="color: #007700"><strong>AND</strong>&nbsp;</span><span style="color: #0000BB">t2</span><span style="color: #007700">.</span><span style="color: #0000BB">module_record_id</span><span style="color: #007700">=</span><span style="color: #0000BB">tbl</span><span style="color: #007700">.</span><span style="color: #0000BB">id&nbsp;
<br>&nbsp;</span><span style="color: #007700"><strong>AND</strong>&nbsp;</span><span style="color: #0000BB">t2</span><span style="color: #007700">.</span><span style="color: #0000BB">language</span><span style="color: #007700">=</span><span style="color: #DD0000">'en'&nbsp;
<br>&nbsp;</span><span style="color: #007700"><strong>AND</strong>&nbsp;</span><span style="color: #0000BB">t2</span><span style="color: #007700">.</span><span style="color: #0000BB">field</span><span style="color: #007700">=</span><span style="color: #DD0000">'preview'&nbsp;
<br>&nbsp;</span><span style="color: #007700"><strong>)</strong>&nbsp;<strong>AS</strong>&nbsp;</span><span style="color: #0000BB">preview</span><span style="color: #007700">,&nbsp;<strong>(</strong></span><span style="color: #0000BB"><strong>SELECT</strong>&nbsp;t3</span><span style="color: #007700">.</span><span style="color: #0000BB">text&nbsp;
<br>&nbsp;<strong>FROM</strong>&nbsp;_texts&nbsp;t3&nbsp;
<br>&nbsp;<strong>WHERE</strong>&nbsp;t3</span><span style="color: #007700">.</span><span style="color: #0000BB">module</span><span style="color: #007700">=</span><span style="color: #DD0000">'blog'&nbsp;
<br>&nbsp;</span><span style="color: #007700"><strong>AND</strong>&nbsp;</span><span style="color: #0000BB">t3</span><span style="color: #007700">.</span><span style="color: #0000BB">module_record_id</span><span style="color: #007700">=</span><span style="color: #0000BB">tbl</span><span style="color: #007700">.</span><span style="color: #0000BB">id&nbsp;
<br>&nbsp;</span><span style="color: #007700"><strong>AND</strong>&nbsp;</span><span style="color: #0000BB">t3</span><span style="color: #007700">.</span><span style="color: #0000BB">language</span><span style="color: #007700">=</span><span style="color: #DD0000">'en'&nbsp;
<br>&nbsp;</span><span style="color: #007700"><strong>AND</strong>&nbsp;</span><span style="color: #0000BB">t3</span><span style="color: #007700">.</span><span style="color: #0000BB">field</span><span style="color: #007700">=</span><span style="color: #DD0000">'text'</span><span style="color: #007700"><strong>)</strong>&nbsp;<strong>AS</strong>&nbsp;</span><span style="color: #0000BB">text_en</span><span style="color: #007700">,&nbsp;<strong>(</strong>&nbsp;
<br>&nbsp;</span><span style="color: #0000BB"><strong>SELECT</strong>&nbsp;t3</span><span style="color: #007700">.</span><span style="color: #0000BB">text&nbsp;
<br>&nbsp;<strong>FROM</strong>&nbsp;_texts&nbsp;t3&nbsp;
<br>&nbsp;<strong>WHERE</strong>&nbsp;t3</span><span style="color: #007700">.</span><span style="color: #0000BB">module</span><span style="color: #007700">=</span><span style="color: #DD0000">'blog'&nbsp;
<br>&nbsp;</span><span style="color: #007700"><strong>AND</strong>&nbsp;</span><span style="color: #0000BB">t3</span><span style="color: #007700">.</span><span style="color: #0000BB">module_record_id</span><span style="color: #007700">=</span><span style="color: #0000BB">tbl</span><span style="color: #007700">.</span><span style="color: #0000BB">id&nbsp;
<br>&nbsp;</span><span style="color: #007700"><strong>AND</strong>&nbsp;</span><span style="color: #0000BB">t3</span><span style="color: #007700">.</span><span style="color: #0000BB">language</span><span style="color: #007700">=</span><span style="color: #DD0000">'en'&nbsp;
<br>&nbsp;</span><span style="color: #007700"><strong>AND</strong>&nbsp;</span><span style="color: #0000BB">t3</span><span style="color: #007700">.</span><span style="color: #0000BB">field</span><span style="color: #007700">=</span><span style="color: #DD0000">'text'&nbsp;
<br>&nbsp;</span><span style="color: #007700"><strong>)</strong>&nbsp;<strong>AS</strong>&nbsp;</span><span style="color: #0000BB">text<br><strong>FROM</strong>&nbsp;</span><span style="color: #007700"><strong>(</strong>`</span><span style="color: #DD0000">blog</span><span style="color: #007700">`&nbsp;</span><span style="color: #0000BB">tbl</span><span style="color: #007700"><strong>)</strong><br></span><span style="color: #0000BB"><strong>LEFT&nbsp;JO<strong>IN</strong></strong>&nbsp;</span><span style="color: #007700">`</span><span style="color: #DD0000">users</span><span style="color: #007700">`&nbsp;</span><span style="color: #0000BB">u&nbsp;<strong>ON</strong>&nbsp;</span><span style="color: #007700">`</span><span style="color: #DD0000">u</span><span style="color: #007700">`.`</span><span style="color: #DD0000">id</span><span style="color: #007700">`=`</span><span style="color: #DD0000">tbl</span><span style="color: #007700">`.`</span><span style="color: #DD0000">created_by</span><span style="color: #007700">`<br></span><span style="color: #0000BB"><strong>LEFT&nbsp;JO<strong>IN</strong></strong>&nbsp;</span><span style="color: #007700">`</span><span style="color: #DD0000">blog_categories</span><span style="color: #007700">`&nbsp;</span><span style="color: #0000BB">bc&nbsp;<strong>ON</strong>&nbsp;</span><span style="color: #007700">`</span><span style="color: #DD0000">bc</span><span style="color: #007700">`.`</span><span style="color: #DD0000">id</span><span style="color: #007700">`=`</span><span style="color: #DD0000">tbl</span><span style="color: #007700">`.`</span><span style="color: #DD0000">category_id</span><span style="color: #007700">`<br></span><span style="color: #0000BB"><strong>WHERE</strong>&nbsp;</span><span style="color: #007700">`</span><span style="color: #DD0000">tbl</span><span style="color: #007700">`.`</span><span style="color: #DD0000">status</span><span style="color: #007700">`&nbsp;=&nbsp;&nbsp;</span><span style="color: #DD0000">'live'<br></span><span style="color: #0000BB"><strong>ORDER&nbsp;BY</strong>&nbsp;</span><span style="color: #007700">`</span><span style="color: #DD0000">created_time</span><span style="color: #007700">`&nbsp;</span><span style="color: #0000BB">DESC<br><strong>LIMIT</strong>&nbsp;10&nbsp;</span>
</span>
</code></td>
									</tr><tr>
										<td style="padding:5px; vertical-align: top;width:1%;color:#900;font-weight:normal;background-color:#ddd;">0.0011&nbsp;&nbsp;</td>
										<td style="padding:5px; color:#000;font-weight:normal;background-color:#ddd;"><code><span style="color: #000000">
<span style="color: #0000BB"><strong>SELECT</strong>&nbsp;<strong>COUNT</strong></span><span style="color: #007700"><strong>(</strong>*<strong>)</strong>&nbsp;<strong>AS</strong>&nbsp;`</span><span style="color: #DD0000">numrows</span><span style="color: #007700">`<br></span><span style="color: #0000BB"><strong>FROM</strong>&nbsp;</span><span style="color: #007700"><strong>(</strong>`</span><span style="color: #DD0000">blog</span><span style="color: #007700">`<strong>)</strong><br></span><span style="color: #0000BB"><strong>WHERE</strong>&nbsp;</span><span style="color: #007700">`</span><span style="color: #DD0000">status</span><span style="color: #007700">`&nbsp;=&nbsp;&nbsp;</span><span style="color: #DD0000">'live'&nbsp;</span>
</span>
</code></td>
									</tr><tr>
										<td style="padding:5px; vertical-align: top;width:1%;color:#900;font-weight:normal;background-color:#ddd;">0.0023&nbsp;&nbsp;</td>
										<td style="padding:5px; color:#000;font-weight:normal;background-color:#ddd;"><code><span style="color: #000000">
<span style="color: #0000BB"><strong>SELECT</strong>&nbsp;</span><span style="color: #007700">`</span><span style="color: #DD0000">tbl</span><span style="color: #007700">`.*,&nbsp;<strong>(</strong></span><span style="color: #0000BB"><strong>SELECT</strong>&nbsp;t1</span><span style="color: #007700">.</span><span style="color: #0000BB">text&nbsp;
<br>&nbsp;<strong>FROM</strong>&nbsp;_texts&nbsp;t1&nbsp;
<br>&nbsp;<strong>WHERE</strong>&nbsp;t1</span><span style="color: #007700">.</span><span style="color: #0000BB">module</span><span style="color: #007700">=</span><span style="color: #DD0000">'blog_categories'&nbsp;
<br>&nbsp;</span><span style="color: #007700"><strong>AND</strong>&nbsp;</span><span style="color: #0000BB">t1</span><span style="color: #007700">.</span><span style="color: #0000BB">module_record_id</span><span style="color: #007700">=</span><span style="color: #0000BB">tbl</span><span style="color: #007700">.</span><span style="color: #0000BB">id&nbsp;
<br>&nbsp;</span><span style="color: #007700"><strong>AND</strong>&nbsp;</span><span style="color: #0000BB">t1</span><span style="color: #007700">.</span><span style="color: #0000BB">language</span><span style="color: #007700">=</span><span style="color: #DD0000">'en'&nbsp;
<br>&nbsp;</span><span style="color: #007700"><strong>AND</strong>&nbsp;</span><span style="color: #0000BB">t1</span><span style="color: #007700">.</span><span style="color: #0000BB">field</span><span style="color: #007700">=</span><span style="color: #DD0000">'title'</span><span style="color: #007700"><strong>)</strong>&nbsp;<strong>AS</strong>&nbsp;</span><span style="color: #0000BB">title_en</span><span style="color: #007700">,&nbsp;<strong>(</strong>&nbsp;
<br>&nbsp;</span><span style="color: #0000BB"><strong>SELECT</strong>&nbsp;t1</span><span style="color: #007700">.</span><span style="color: #0000BB">text&nbsp;
<br>&nbsp;<strong>FROM</strong>&nbsp;_texts&nbsp;t1&nbsp;
<br>&nbsp;<strong>WHERE</strong>&nbsp;t1</span><span style="color: #007700">.</span><span style="color: #0000BB">module</span><span style="color: #007700">=</span><span style="color: #DD0000">'blog_categories'&nbsp;
<br>&nbsp;</span><span style="color: #007700"><strong>AND</strong>&nbsp;</span><span style="color: #0000BB">t1</span><span style="color: #007700">.</span><span style="color: #0000BB">module_record_id</span><span style="color: #007700">=</span><span style="color: #0000BB">tbl</span><span style="color: #007700">.</span><span style="color: #0000BB">id&nbsp;
<br>&nbsp;</span><span style="color: #007700"><strong>AND</strong>&nbsp;</span><span style="color: #0000BB">t1</span><span style="color: #007700">.</span><span style="color: #0000BB">language</span><span style="color: #007700">=</span><span style="color: #DD0000">'en'&nbsp;
<br>&nbsp;</span><span style="color: #007700"><strong>AND</strong>&nbsp;</span><span style="color: #0000BB">t1</span><span style="color: #007700">.</span><span style="color: #0000BB">field</span><span style="color: #007700">=</span><span style="color: #DD0000">'title'&nbsp;
<br>&nbsp;</span><span style="color: #007700"><strong>)</strong>&nbsp;<strong>AS</strong>&nbsp;</span><span style="color: #0000BB">title<br><strong>FROM</strong>&nbsp;</span><span style="color: #007700"><strong>(</strong>`</span><span style="color: #DD0000">blog_categories</span><span style="color: #007700">`&nbsp;</span><span style="color: #0000BB">tbl</span><span style="color: #007700"><strong>)</strong><br></span><span style="color: #0000BB"><strong>ORDER&nbsp;BY</strong>&nbsp;</span><span style="color: #007700">`</span><span style="color: #DD0000">id</span><span style="color: #007700">`&nbsp;</span><span style="color: #0000BB">DESC&nbsp;</span>
</span>
</code></td>
									</tr><tr>
										<td style="padding:5px; vertical-align: top;width:1%;color:#900;font-weight:normal;background-color:#ddd;">0.0006&nbsp;&nbsp;</td>
										<td style="padding:5px; color:#000;font-weight:normal;background-color:#ddd;"><code><span style="color: #000000">
<span style="color: #0000BB"><strong>SELECT</strong>&nbsp;<strong>DIST<strong>IN</strong>CT</strong>&nbsp;</span><span style="color: #007700">`</span><span style="color: #DD0000">created_time</span><span style="color: #007700">`<br></span><span style="color: #0000BB"><strong>FROM</strong>&nbsp;</span><span style="color: #007700"><strong>(</strong>`</span><span style="color: #DD0000">blog</span><span style="color: #007700">`<strong>)</strong><br></span><span style="color: #0000BB"><strong>WHERE</strong>&nbsp;</span><span style="color: #007700">`</span><span style="color: #DD0000">status</span><span style="color: #007700">`&nbsp;=&nbsp;&nbsp;</span><span style="color: #DD0000">'live'<br></span><span style="color: #0000BB"><strong>ORDER&nbsp;BY</strong>&nbsp;</span><span style="color: #007700">`</span><span style="color: #DD0000">created_time</span><span style="color: #007700">`&nbsp;</span><span style="color: #0000BB">DESC&nbsp;</span>
</span>
</code></td>
									</tr><tr>
								<td style="padding:5px; vertical-align: top;width:1%;color:#900;font-weight:normal;background-color:#ddd;">0.0146</td>
							</tr></tbody></table>
</fieldset>

<fieldset style="border:1px solid #000;padding:6px 10px 10px 10px;margin:20px 0 20px 0;background-color:#eee" id="ci_profiler_http_headers">
<legend style="color:#000;">&nbsp;&nbsp;HTTP HEADERS&nbsp;&nbsp;(<span onclick="var s=document.getElementById('ci_profiler_httpheaders_table').style;s.display=s.display=='none'?'':'none';this.innerHTML=this.innerHTML=='Show'?'Hide':'Show';" style="cursor: pointer;">Show</span>)</legend>


<table id="ci_profiler_httpheaders_table" style="width:100%;display:none">
<tbody><tr><td style="vertical-align: top;width:50%;padding:5px;color:#900;background-color:#ddd;">HTTP_ACCEPT&nbsp;&nbsp;</td><td style="width:50%;padding:5px;color:#000;background-color:#ddd;">text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8</td></tr>
<tr><td style="vertical-align: top;width:50%;padding:5px;color:#900;background-color:#ddd;">HTTP_USER_AGENT&nbsp;&nbsp;</td><td style="width:50%;padding:5px;color:#000;background-color:#ddd;">Mozilla/5.0 (Windows NT 6.1; WOW64; rv:13.0) Gecko/20100101 Firefox/13.0.1 FirePHP/0.7.1</td></tr>
<tr><td style="vertical-align: top;width:50%;padding:5px;color:#900;background-color:#ddd;">HTTP_CONNECTION&nbsp;&nbsp;</td><td style="width:50%;padding:5px;color:#000;background-color:#ddd;">keep-alive</td></tr>
<tr><td style="vertical-align: top;width:50%;padding:5px;color:#900;background-color:#ddd;">SERVER_PORT&nbsp;&nbsp;</td><td style="width:50%;padding:5px;color:#000;background-color:#ddd;">80</td></tr>
<tr><td style="vertical-align: top;width:50%;padding:5px;color:#900;background-color:#ddd;">SERVER_NAME&nbsp;&nbsp;</td><td style="width:50%;padding:5px;color:#000;background-color:#ddd;">localhost</td></tr>
<tr><td style="vertical-align: top;width:50%;padding:5px;color:#900;background-color:#ddd;">REMOTE_ADDR&nbsp;&nbsp;</td><td style="width:50%;padding:5px;color:#000;background-color:#ddd;">127.0.0.1</td></tr>
<tr><td style="vertical-align: top;width:50%;padding:5px;color:#900;background-color:#ddd;">SERVER_SOFTWARE&nbsp;&nbsp;</td><td style="width:50%;padding:5px;color:#000;background-color:#ddd;">Apache/2.2.21 (Win32) PHP/5.4.0</td></tr>
<tr><td style="vertical-align: top;width:50%;padding:5px;color:#900;background-color:#ddd;">HTTP_ACCEPT_LANGUAGE&nbsp;&nbsp;</td><td style="width:50%;padding:5px;color:#000;background-color:#ddd;">en-us,en;q=0.5</td></tr>
<tr><td style="vertical-align: top;width:50%;padding:5px;color:#900;background-color:#ddd;">SCRIPT_NAME&nbsp;&nbsp;</td><td style="width:50%;padding:5px;color:#000;background-color:#ddd;">/ci_mx/index.php</td></tr>
<tr><td style="vertical-align: top;width:50%;padding:5px;color:#900;background-color:#ddd;">REQUEST_METHOD&nbsp;&nbsp;</td><td style="width:50%;padding:5px;color:#000;background-color:#ddd;">GET</td></tr>
<tr><td style="vertical-align: top;width:50%;padding:5px;color:#900;background-color:#ddd;"> HTTP_HOST&nbsp;&nbsp;</td><td style="width:50%;padding:5px;color:#000;background-color:#ddd;"></td></tr>
<tr><td style="vertical-align: top;width:50%;padding:5px;color:#900;background-color:#ddd;">REMOTE_HOST&nbsp;&nbsp;</td><td style="width:50%;padding:5px;color:#000;background-color:#ddd;"></td></tr>
<tr><td style="vertical-align: top;width:50%;padding:5px;color:#900;background-color:#ddd;">CONTENT_TYPE&nbsp;&nbsp;</td><td style="width:50%;padding:5px;color:#000;background-color:#ddd;"></td></tr>
<tr><td style="vertical-align: top;width:50%;padding:5px;color:#900;background-color:#ddd;">SERVER_PROTOCOL&nbsp;&nbsp;</td><td style="width:50%;padding:5px;color:#000;background-color:#ddd;">HTTP/1.1</td></tr>
<tr><td style="vertical-align: top;width:50%;padding:5px;color:#900;background-color:#ddd;">QUERY_STRING&nbsp;&nbsp;</td><td style="width:50%;padding:5px;color:#000;background-color:#ddd;">_profiler</td></tr>
<tr><td style="vertical-align: top;width:50%;padding:5px;color:#900;background-color:#ddd;">HTTP_ACCEPT_ENCODING&nbsp;&nbsp;</td><td style="width:50%;padding:5px;color:#000;background-color:#ddd;">gzip, deflate</td></tr>
<tr><td style="vertical-align: top;width:50%;padding:5px;color:#900;background-color:#ddd;">HTTP_X_FORWARDED_FOR&nbsp;&nbsp;</td><td style="width:50%;padding:5px;color:#000;background-color:#ddd;"></td></tr>
</tbody></table>
</fieldset><fieldset style="border:1px solid #000;padding:6px 10px 10px 10px;margin:20px 0 20px 0;background-color:#eee" id="ci_profiler_csession"><legend style="color:#000;">&nbsp;&nbsp;SESSION DATA&nbsp;&nbsp;(<span onclick="var s=document.getElementById('ci_profiler_session_data').style;s.display=s.display=='none'?'':'none';this.innerHTML=this.innerHTML=='Show'?'Hide':'Show';" style="cursor: pointer;">Show</span>)</legend><table id="ci_profiler_session_data" style="width:100%;display:none"><tbody><tr><td style="padding:5px; vertical-align: top;color:#900;background-color:#ddd;">session_id&nbsp;&nbsp;</td><td style="padding:5px; color:#000;background-color:#ddd;">32a92cc004e01a364fa5c6ac706a1e1c</td></tr>
<tr><td style="padding:5px; vertical-align: top;color:#900;background-color:#ddd;">ip_address&nbsp;&nbsp;</td><td style="padding:5px; color:#000;background-color:#ddd;">127.0.0.1</td></tr>
<tr><td style="padding:5px; vertical-align: top;color:#900;background-color:#ddd;">user_agent&nbsp;&nbsp;</td><td style="padding:5px; color:#000;background-color:#ddd;">Mozilla/5.0 (Windows NT 6.1; WOW64; rv:13.0) Gecko/20100101 Firefox/13.0.1 FirePHP/0.7.1</td></tr>
<tr><td style="padding:5px; vertical-align: top;color:#900;background-color:#ddd;">last_activity&nbsp;&nbsp;</td><td style="padding:5px; color:#000;background-color:#ddd;">1341097766</td></tr>
<tr><td style="padding:5px; vertical-align: top;color:#900;background-color:#ddd;">user_data&nbsp;&nbsp;</td><td style="padding:5px; color:#000;background-color:#ddd;"></td></tr>
<tr><td style="padding:5px; vertical-align: top;color:#900;background-color:#ddd;">user&nbsp;&nbsp;</td><td style="padding:5px; color:#000;background-color:#ddd;">2</td></tr>
</tbody></table></fieldset>

<fieldset style="border:1px solid #000;padding:6px 10px 10px 10px;margin:20px 0 20px 0;background-color:#eee" id="ci_profiler_config">
<legend style="color:#000;">&nbsp;&nbsp;CONFIG VARIABLES&nbsp;&nbsp;(<span onclick="var s=document.getElementById('ci_profiler_config_table').style;s.display=s.display=='none'?'':'none';this.innerHTML=this.innerHTML=='Show'?'Hide':'Show';" style="cursor: pointer;">Show</span>)</legend>


<table id="ci_profiler_config_table" style="width:100%; display:none">
<tbody><tr><td style="padding:5px; vertical-align: top;color:#900;background-color:#ddd;">base_url&nbsp;&nbsp;</td><td style="padding:5px; color:#000;background-color:#ddd;">http://localhost/ci_mx/</td></tr>
<tr><td style="padding:5px; vertical-align: top;color:#900;background-color:#ddd;">index_page&nbsp;&nbsp;</td><td style="padding:5px; color:#000;background-color:#ddd;"></td></tr>
<tr><td style="padding:5px; vertical-align: top;color:#900;background-color:#ddd;">uri_protocol&nbsp;&nbsp;</td><td style="padding:5px; color:#000;background-color:#ddd;">AUTO</td></tr>
<tr><td style="padding:5px; vertical-align: top;color:#900;background-color:#ddd;">url_suffix&nbsp;&nbsp;</td><td style="padding:5px; color:#000;background-color:#ddd;"></td></tr>
<tr><td style="padding:5px; vertical-align: top;color:#900;background-color:#ddd;">language&nbsp;&nbsp;</td><td style="padding:5px; color:#000;background-color:#ddd;">en</td></tr>
<tr><td style="padding:5px; vertical-align: top;color:#900;background-color:#ddd;">charset&nbsp;&nbsp;</td><td style="padding:5px; color:#000;background-color:#ddd;">UTF-8</td></tr>
<tr><td style="padding:5px; vertical-align: top;color:#900;background-color:#ddd;">enable_hooks&nbsp;&nbsp;</td><td style="padding:5px; color:#000;background-color:#ddd;">1</td></tr>
<tr><td style="padding:5px; vertical-align: top;color:#900;background-color:#ddd;">subclass_prefix&nbsp;&nbsp;</td><td style="padding:5px; color:#000;background-color:#ddd;">MX2_</td></tr>
<tr><td style="padding:5px; vertical-align: top;color:#900;background-color:#ddd;">permitted_uri_chars&nbsp;&nbsp;</td><td style="padding:5px; color:#000;background-color:#ddd;">a-z 0-9~%.:_\-</td></tr>
<tr><td style="padding:5px; vertical-align: top;color:#900;background-color:#ddd;">allow_get_array&nbsp;&nbsp;</td><td style="padding:5px; color:#000;background-color:#ddd;">1</td></tr>
<tr><td style="padding:5px; vertical-align: top;color:#900;background-color:#ddd;">enable_query_strings&nbsp;&nbsp;</td><td style="padding:5px; color:#000;background-color:#ddd;">1</td></tr>
<tr><td style="padding:5px; vertical-align: top;color:#900;background-color:#ddd;">log_threshold&nbsp;&nbsp;</td><td style="padding:5px; color:#000;background-color:#ddd;">1</td></tr>
<tr><td style="padding:5px; vertical-align: top;color:#900;background-color:#ddd;">log_path&nbsp;&nbsp;</td><td style="padding:5px; color:#000;background-color:#ddd;"></td></tr>
<tr><td style="padding:5px; vertical-align: top;color:#900;background-color:#ddd;">log_date_format&nbsp;&nbsp;</td><td style="padding:5px; color:#000;background-color:#ddd;">d-m-Y H:i:s</td></tr>
<tr><td style="padding:5px; vertical-align: top;color:#900;background-color:#ddd;">cache_path&nbsp;&nbsp;</td><td style="padding:5px; color:#000;background-color:#ddd;"></td></tr>
<tr><td style="padding:5px; vertical-align: top;color:#900;background-color:#ddd;">encryption_key&nbsp;&nbsp;</td><td style="padding:5px; color:#000;background-color:#ddd;">sadasdasd</td></tr>
<tr><td style="padding:5px; vertical-align: top;color:#900;background-color:#ddd;">sess_cookie_name&nbsp;&nbsp;</td><td style="padding:5px; color:#000;background-color:#ddd;">cimx2session</td></tr>
<tr><td style="padding:5px; vertical-align: top;color:#900;background-color:#ddd;">sess_expiration&nbsp;&nbsp;</td><td style="padding:5px; color:#000;background-color:#ddd;">0</td></tr>
<tr><td style="padding:5px; vertical-align: top;color:#900;background-color:#ddd;">sess_expire_on_close&nbsp;&nbsp;</td><td style="padding:5px; color:#000;background-color:#ddd;">1</td></tr>
<tr><td style="padding:5px; vertical-align: top;color:#900;background-color:#ddd;">sess_encrypt_cookie&nbsp;&nbsp;</td><td style="padding:5px; color:#000;background-color:#ddd;">1</td></tr>
<tr><td style="padding:5px; vertical-align: top;color:#900;background-color:#ddd;">sess_use_database&nbsp;&nbsp;</td><td style="padding:5px; color:#000;background-color:#ddd;">1</td></tr>
<tr><td style="padding:5px; vertical-align: top;color:#900;background-color:#ddd;">sess_table_name&nbsp;&nbsp;</td><td style="padding:5px; color:#000;background-color:#ddd;">ci_mx2_sessions</td></tr>
<tr><td style="padding:5px; vertical-align: top;color:#900;background-color:#ddd;">sess_match_ip&nbsp;&nbsp;</td><td style="padding:5px; color:#000;background-color:#ddd;"></td></tr>
<tr><td style="padding:5px; vertical-align: top;color:#900;background-color:#ddd;">sess_match_useragent&nbsp;&nbsp;</td><td style="padding:5px; color:#000;background-color:#ddd;"></td></tr>
<tr><td style="padding:5px; vertical-align: top;color:#900;background-color:#ddd;">sess_time_to_update&nbsp;&nbsp;</td><td style="padding:5px; color:#000;background-color:#ddd;">300</td></tr>
<tr><td style="padding:5px; vertical-align: top;color:#900;background-color:#ddd;">cookie_prefix&nbsp;&nbsp;</td><td style="padding:5px; color:#000;background-color:#ddd;"></td></tr>
<tr><td style="padding:5px; vertical-align: top;color:#900;background-color:#ddd;">cookie_domain&nbsp;&nbsp;</td><td style="padding:5px; color:#000;background-color:#ddd;"></td></tr>
<tr><td style="padding:5px; vertical-align: top;color:#900;background-color:#ddd;">cookie_path&nbsp;&nbsp;</td><td style="padding:5px; color:#000;background-color:#ddd;">/</td></tr>
<tr><td style="padding:5px; vertical-align: top;color:#900;background-color:#ddd;">cookie_secure&nbsp;&nbsp;</td><td style="padding:5px; color:#000;background-color:#ddd;"></td></tr>
<tr><td style="padding:5px; vertical-align: top;color:#900;background-color:#ddd;">global_xss_filtering&nbsp;&nbsp;</td><td style="padding:5px; color:#000;background-color:#ddd;"></td></tr>
<tr><td style="padding:5px; vertical-align: top;color:#900;background-color:#ddd;">csrf_protection&nbsp;&nbsp;</td><td style="padding:5px; color:#000;background-color:#ddd;"></td></tr>
<tr><td style="padding:5px; vertical-align: top;color:#900;background-color:#ddd;">csrf_token_name&nbsp;&nbsp;</td><td style="padding:5px; color:#000;background-color:#ddd;">csrf_ci_mx</td></tr>
<tr><td style="padding:5px; vertical-align: top;color:#900;background-color:#ddd;">csrf_cookie_name&nbsp;&nbsp;</td><td style="padding:5px; color:#000;background-color:#ddd;">csrf_ci_mx_cookie</td></tr>
<tr><td style="padding:5px; vertical-align: top;color:#900;background-color:#ddd;">csrf_expire&nbsp;&nbsp;</td><td style="padding:5px; color:#000;background-color:#ddd;">7200</td></tr>
<tr><td style="padding:5px; vertical-align: top;color:#900;background-color:#ddd;">compress_output&nbsp;&nbsp;</td><td style="padding:5px; color:#000;background-color:#ddd;"></td></tr>
<tr><td style="padding:5px; vertical-align: top;color:#900;background-color:#ddd;">time_reference&nbsp;&nbsp;</td><td style="padding:5px; color:#000;background-color:#ddd;">local</td></tr>
<tr><td style="padding:5px; vertical-align: top;color:#900;background-color:#ddd;">rewrite_short_tags&nbsp;&nbsp;</td><td style="padding:5px; color:#000;background-color:#ddd;"></td></tr>
<tr><td style="padding:5px; vertical-align: top;color:#900;background-color:#ddd;">proxy_ips&nbsp;&nbsp;</td><td style="padding:5px; color:#000;background-color:#ddd;"></td></tr>
<tr><td style="padding:5px; vertical-align: top;color:#900;background-color:#ddd;">modules_locations&nbsp;&nbsp;</td><td style="padding:5px; color:#000;background-color:#ddd;">Array
(
    [extensions/modules/] =&gt; ../../extensions/modules/
    [core/modules/] =&gt; ../modules/
)
</td></tr>
<tr><td style="padding:5px; vertical-align: top;color:#900;background-color:#ddd;">environment&nbsp;&nbsp;</td><td style="padding:5px; color:#000;background-color:#ddd;">development</td></tr>
<tr><td style="padding:5px; vertical-align: top;color:#900;background-color:#ddd;">ci_system_path&nbsp;&nbsp;</td><td style="padding:5px; color:#000;background-color:#ddd;">codeigniter</td></tr>
<tr><td style="padding:5px; vertical-align: top;color:#900;background-color:#ddd;">supported_languages&nbsp;&nbsp;</td><td style="padding:5px; color:#000;background-color:#ddd;">Array
(
    [en] =&gt; Array
        (
            [name] =&gt; English
            [folder] =&gt; en
        )

)
</td></tr>
<tr><td style="padding:5px; vertical-align: top;color:#900;background-color:#ddd;">default_language&nbsp;&nbsp;</td><td style="padding:5px; color:#000;background-color:#ddd;">en</td></tr>
<tr><td style="padding:5px; vertical-align: top;color:#900;background-color:#ddd;">lang_switch_method&nbsp;&nbsp;</td><td style="padding:5px; color:#000;background-color:#ddd;">url</td></tr>
<tr><td style="padding:5px; vertical-align: top;color:#900;background-color:#ddd;">wrong_language&nbsp;&nbsp;</td><td style="padding:5px; color:#000;background-color:#ddd;">error</td></tr>
<tr><td style="padding:5px; vertical-align: top;color:#900;background-color:#ddd;">cookie_remember_lang&nbsp;&nbsp;</td><td style="padding:5px; color:#000;background-color:#ddd;">1</td></tr>
<tr><td style="padding:5px; vertical-align: top;color:#900;background-color:#ddd;">lang_cookie_name&nbsp;&nbsp;</td><td style="padding:5px; color:#000;background-color:#ddd;">lang</td></tr>
<tr><td style="padding:5px; vertical-align: top;color:#900;background-color:#ddd;">get_param_lang_name&nbsp;&nbsp;</td><td style="padding:5px; color:#000;background-color:#ddd;">lang</td></tr>
<tr><td style="padding:5px; vertical-align: top;color:#900;background-color:#ddd;">ignore_lang_paths&nbsp;&nbsp;</td><td style="padding:5px; color:#000;background-color:#ddd;">Array
(
    [0] =&gt; admin
    [1] =&gt; ajax
    [2] =&gt; files
)
</td></tr>
<tr><td style="padding:5px; vertical-align: top;color:#900;background-color:#ddd;">mx_cache_enabled&nbsp;&nbsp;</td><td style="padding:5px; color:#000;background-color:#ddd;">1</td></tr>
<tr><td style="padding:5px; vertical-align: top;color:#900;background-color:#ddd;">cache_type&nbsp;&nbsp;</td><td style="padding:5px; color:#000;background-color:#ddd;">files</td></tr>
<tr><td style="padding:5px; vertical-align: top;color:#900;background-color:#ddd;">cache_dir&nbsp;&nbsp;</td><td style="padding:5px; color:#000;background-color:#ddd;">core/cache/</td></tr>
<tr><td style="padding:5px; vertical-align: top;color:#900;background-color:#ddd;">blog_statuses&nbsp;&nbsp;</td><td style="padding:5px; color:#000;background-color:#ddd;">Array
(
    [draft] =&gt; Draft
    [live] =&gt; Live
    [_preview] =&gt; Preview
    [_auto_save] =&gt; Auto save
)
</td></tr>
</tbody></table>
</fieldset>
</div>