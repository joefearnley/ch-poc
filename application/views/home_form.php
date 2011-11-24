	<div id="content" class="center">
		
<?php echo validation_errors();  ?>

	<form action="home/" method="post">
			<h1>Where are you going to live next semester? </h1>
			<select name="schoolid">
				<option value="">choose a school</option>
			<?php 
				foreach($schools->result() as $school):
					print "<option value=\"".$school->id."\">".$school->description."</option>\n";
				endforeach;
			?>
			</select>
			<p><input type="submit" value="go!" /></p>
		</form>
	</div>
