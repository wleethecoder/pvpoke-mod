<div class="poke multi">
	<div class="poke-stats">
		<div class="custom-options">
			<h3 class="section-title">Pokemon (<span class="poke-count">0</span> / <span class="poke-max-count">1</span>)</h3>
			<p>Select the Pokemon you want to build a team around.</p>
			
			<div class="rankings-container clear"></div>
			
			<button class="add-poke-btn button">+ Add Pokemon</button>
			
			<div class="analysis-settings">
				<h4>Analysis Settings</h4>
				<div class="setting-row">
					<label for="threat-count">Top Threats:</label>
					<select id="threat-count" class="threat-count-select">
						<option value="10">10</option>
						<option value="15">15</option>
						<option value="20" selected>20</option>
						<option value="25">25</option>
						<option value="30">30</option>
					</select>
				</div>
				<div class="setting-row">
					<label for="counter-count">Top Counters:</label>
					<select id="counter-count" class="counter-count-select">
						<option value="10">10</option>
						<option value="15" selected>15</option>
						<option value="20">20</option>
						<option value="25">25</option>
					</select>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="hide">
	<?php require 'pokeselect.php'; ?>
</div>

<div class="remove-poke-confirm hide">
	<p>Remove <b><span class="name"></span></b> from the group?</p>

	<div class="center flex">
		<div class="button yes">Yes</div>
		<div class="button no">No</div>
	</div>
</div>