<?php

$META_TITLE = 'Modded Team Builder';

$META_DESCRIPTION = 'Advanced team builder for Pokemon GO Trainer Battles with enhanced threat analysis, matrix calculations, and safe switch recommendations.';

$CANONICAL = '/modded-team-builder/';

require_once 'header.php';

?>

<h1>Modded Team Builder</h1>

<div class="section league-select-container team-content white">
	<p>Select your Pokemon and league below. This enhanced team builder will show you the top threats, best teammates, and safe switch options.</p>
	<?php require 'modules/formatselect.php'; ?>
</div>

<div class="section team-build poke-select-container">
	<?php require 'modules/moddedpokeselect.php'; ?>
</div>

<button class="build-btn button">
	<span class="btn-content-wrap">
		<span class="btn-icon btn-icon-team"></span>
		<span class="btn-label">Build Team</span>
	</span>
</button>

<div class="section white error">Please select a Pokemon first.</div>

<!-- Matrix Battle Section -->
<div class="section matrix-battle-section poke-select-container" style="display: none;">
	<div class="matrix-header">
		<h2>Matrix Battle Analysis</h2>
		<p>Battle the top threats against their best counters. Lists are auto-populated from your team analysis.</p>
	</div>
	
	<div class="matrix-columns" style="display: flex; gap: 20px; margin: 20px 0;">
		<div style="flex: 1;">
			<h3>Counters (List 2)</h3>
			<?php require 'modules/pokemultiselect.php'; ?>
		</div>
		<div style="flex: 1;">
			<h3>Threats (List 1)</h3>
			<?php require 'modules/pokemultiselect.php'; ?>
		</div>
	</div>
	
	<div class="matrix-battle-button" style="text-align: center; margin-top: 20px;">
		<button class="matrix-battle-btn button">
			<span class="btn-content-wrap">
				<span class="btn-icon btn-icon-battle"></span>
				<span class="btn-label">Battle</span>
			</span>
		</button>
	</div>
</div>

<!-- Matrix Results Section -->
<div class="section white battle-results matrix matrix-results" style="display: none;">
	<h2>Matrix Battle Results</h2>
	<p>Battle results matrix: Threats (rows) vs Counters (columns). Values above 500 indicate wins.</p>
	<div class="matrix-sort-container" style="margin-bottom: 15px;">
		<label for="matrix-sort-select" style="margin-right: 10px; font-weight: bold;">Sort by:</label>
		<select id="matrix-sort-select" style="padding: 6px 8px; border: 1px solid #ddd; border-radius: 4px; background: white; font-size: 13px;">
			<option value="none">None</option>
			<option value="average">Average Battle Rating</option>
			<option value="wins">Most Wins</option>
			<option value="flexibility">Flexibility</option>
		</select>
	</div>
	<div class="matrix-container">
		<!-- Matrix table will be populated here -->
	</div>
</div>

<style>
.threats-list {
	margin-top: 20px;
}

.threat-item {
	display: flex;
	align-items: center;
	padding: 8px 0;
	border-bottom: 1px solid #eee;
}

.threat-item .rank {
	width: 30px;
	font-weight: bold;
	color: #666;
}

.threat-item .name {
	flex: 1;
	margin-left: 10px;
	font-weight: bold;
}

.threat-item .score {
	width: 60px;
	text-align: right;
	color: #333;
}

.analysis-settings {
	margin-top: 20px;
	padding-top: 20px;
	border-top: 1px solid #eee;
}

.analysis-settings h4 {
	margin: 0 0 15px 0;
	font-size: 14px;
	font-weight: bold;
	color: #333;
}

.setting-row {
	display: flex;
	align-items: center;
	margin-bottom: 10px;
}

.setting-row label {
	width: 100px;
	font-size: 13px;
	color: #666;
	margin-right: 10px;
}

.setting-row select {
	padding: 6px 8px;
	border: 1px solid #ddd;
	border-radius: 4px;
	background: white;
	font-size: 13px;
	min-width: 60px;
}

/* Matrix Battle Styles */
.matrix-battle-section {
	margin-top: 30px;
	display: flex !important;
	flex-direction: column !important;
}

.matrix-battle-section h2 {
	margin-bottom: 10px;
}

.matrix-battle-section p {
	margin-bottom: 20px;
	color: #666;
}

.matrix-header {
	width: 100%;
}

.matrix-columns {
	width: 100%;
}

.matrix-battle-button {
	width: 100%;
}

/* Matrix Results Styles */
.matrix-results {
	margin-top: 20px;
}

/* Ensure Matrix PokeMultiSelect containers are visible */
.matrix-battle-section .poke.multi {
	display: block !important;
	visibility: visible !important;
	height: auto !important;
}

.matrix-battle-section .rankings-container {
	display: block !important;
	visibility: visible !important;
	height: auto !important;
	max-height: 400px;
	overflow-y: auto;
}

.matrix-battle-section .poke.multi .poke-stats {
	display: block !important;
	visibility: visible !important;
}

.matrix-battle-section .rank {
	display: block !important;
	visibility: visible !important;
	margin-bottom: 5px;
}

.matrix-battle-section .custom-options {
	display: block !important;
}

.matrix-container {
	overflow-x: auto;
	margin-top: 15px;
}

.matrix-table {
	width: 100%;
	border-collapse: collapse;
	font-size: 13px;
}

.matrix-table th,
.matrix-table td {
	border: 1px solid #ddd;
	padding: 6px 8px;
	text-align: center;
}

.matrix-table .matrix-header {
	background: #f5f5f5;
	font-weight: bold;
	font-size: 12px;
	writing-mode: vertical-rl;
	text-orientation: mixed;
	max-width: 100px;
}

.matrix-table .matrix-row-header {
	background: #f5f5f5;
	font-weight: bold;
	text-align: left;
	white-space: nowrap;
	min-width: 120px;
}

.matrix-table .matrix-cell {
	font-weight: bold;
	min-width: 50px;
}

.matrix-table .matrix-cell.win {
	background: #d4edda;
	color: #155724;
}

.matrix-table .matrix-cell.loss {
	background: #f8d7da;
	color: #721c24;
}

.matrix-table .matrix-cell.tie {
	background: #fff3cd;
	color: #856404;
}

/* Record and Average column styles */
.matrix-table .record {
	font-weight: bold;
	text-align: center;
	min-width: 60px;
	background: #444;
	color: #eee;
}

.matrix-table .average {
	font-weight: bold;
	text-align: center;
	min-width: 50px;
	background: #444;
	color: #eee;
}

.matrix-table .record-cell {
	text-align: center;
	font-weight: bold;
	border-left: 2px solid #dee2e6;
}

.matrix-table .average-cell {
	text-align: center;
	font-weight: bold;
	border-left: 1px solid #dee2e6;
}
</style>

<?php require_once 'modules/search-string-help.php'; ?>
<?php require_once 'modules/search-traits.php'; ?>

<script src="<?php echo $WEB_ROOT; ?>js/GameMaster.js?v=<?php echo $SITE_VERSION; ?>"></script>
<script src="<?php echo $WEB_ROOT; ?>js/battle/DamageCalculator.js?v=<?php echo $SITE_VERSION; ?>"></script>
<script src="<?php echo $WEB_ROOT; ?>js/pokemon/Pokemon.js?v=<?php echo $SITE_VERSION; ?>"></script>
<script src="<?php echo $WEB_ROOT; ?>js/interface/TeamInterface.js?v=<?php echo $SITE_VERSION; ?>"></script>
<script src="<?php echo $WEB_ROOT; ?>js/interface/PokeMultiSelect.js?v=<?php echo $SITE_VERSION; ?>"></script>
<script src="<?php echo $WEB_ROOT; ?>js/interface/Pokebox.js?=<?php echo $SITE_VERSION; ?>"></script>
<script src="<?php echo $WEB_ROOT; ?>js/interface/PokeSelect.js?v=<?php echo $SITE_VERSION; ?>"></script>
<script src="<?php echo $WEB_ROOT; ?>js/interface/BattleHistogram.js?v=<?php echo $SITE_VERSION; ?>"></script>
<script src="<?php echo $WEB_ROOT; ?>js/interface/ModalWindow.js?v=<?php echo $SITE_VERSION; ?>"></script>
<script src="<?php echo $WEB_ROOT; ?>js/interface/PokeSearch.js?v=<?php echo $SITE_VERSION; ?>"></script>
<script src="<?php echo $WEB_ROOT; ?>js/battle/timeline/TimelineEvent.js?v=<?php echo $SITE_VERSION; ?>"></script>
<script src="<?php echo $WEB_ROOT; ?>js/battle/timeline/TimelineAction.js?v=<?php echo $SITE_VERSION; ?>"></script>
<script src="<?php echo $WEB_ROOT; ?>js/battle/Battle.js?v=<?php echo $SITE_VERSION; ?>"></script>
<script src="<?php echo $WEB_ROOT; ?>js/battle/rankers/TeamRanker.js?v=<?php echo $SITE_VERSION; ?>"></script>
<script src="<?php echo $WEB_ROOT; ?>js/battle/actions/ActionLogic.js?v=<?php echo $SITE_VERSION; ?>"></script>

<script>
	$(document).ready(function(){
		// Initialize modded team builder interface
		setTimeout(function(){			
			// Initialize our own PokeMultiSelect instance for the modded team builder
			var gm = GameMaster.getInstance();
			var battle = new Battle();
			
			// Create our own PokeMultiSelect instance
			var moddedMultiSelect = new PokeMultiSelect($('.team-build .poke.multi'));
			moddedMultiSelect.init(gm.data.pokemon, battle);
			moddedMultiSelect.setMaxPokemonCount(1);
			
			console.log('Modded PokeMultiSelect initialized with max count 1');
			
			// Store reference globally so we can access it later
			window.moddedMultiSelect = moddedMultiSelect;
			
			// Add format selector change handler to update battle and multi-selector
			$(".format-select").on("change", function(){
				var cp = $(".format-select option:selected").val();
				var cup = $(".format-select option:selected").attr("cup");
				
				console.log('Format changed to:', cp, 'CP,', cup, 'cup');
				
				battle.setCP(cp);
				battle.setCup(cup);
				
				var levelCap = 50;
				if(battle.getCup().levelCap){
					levelCap = battle.getCup().levelCap;
				}
				battle.setLevelCap(levelCap);
				
				// Update the multi-selector with new CP and level cap
				moddedMultiSelect.setCP(cp);
				moddedMultiSelect.setLevelCap(levelCap);
				
				console.log('Battle object updated with CP:', battle.getCP(), 'Cup:', battle.getCup().name);
			});
			
			// Add Build Team button functionality
			$('.build-btn').click(function(){
				var selectedPokemon = moddedMultiSelect.getPokemonList();
				
				if(selectedPokemon.length === 0){
					$('.error').show();
					return;
				}
				
				$('.error').hide();
				console.log('Building team for:', selectedPokemon[0].speciesName);
				
				// Calculate threats
				calculateThreats(selectedPokemon, battle, gm);
			});
			
		}, 1000);
		
		// Global variables to store calculated lists
		var calculatedThreats = [];
		var calculatedCounters = [];
		
		// Function to calculate threats against selected Pokemon
		function calculateThreats(team, battle, gm){
			console.log('Calculating threats...');
			
			// Get current format settings
			var cup = battle.getCup();
			var cp = battle.getCP();
			
			// Use RankerMaster to calculate threats
			var ranker = RankerMaster.getInstance();
			var result = ranker.rank(team, cp, cup, [], "threats");
			
			// Extract the rankings array from the result object
			var rankings = result.rankings;
			
			// Sort by score (descending order - highest threats first)
			rankings.sort(function(a, b) {
				return b.score - a.score;
			});
			
			// Get the selected number of threats from dropdown
			var threatCount = parseInt($('#threat-count').val());
			var topThreats = rankings.slice(0, threatCount);
			
			// Display the threats
			displayThreats(topThreats, battle, gm);
		}
		
		// Function to display threats (console only for now)
		function displayThreats(threats, battle, gm){
			// Store threats globally
			calculatedThreats = threats;
			
			var threatCount = threats.length;
			console.log('=== TOP ' + threatCount + ' THREATS (LIST 1) ===');
			threats.forEach(function(threat, index){
				console.log((index + 1) + '. ' + threat.speciesName + ' (Score: ' + Math.round(threat.score) + ')');
			});
			console.log('=== END LIST 1 ===');
			
			// Now calculate counters against these threats
			calculateCounters(threats, battle, gm);
		}
		
		// Function to calculate top k counters against the threats
		function calculateCounters(threats, battle, gm){
			console.log('Calculating counters against threats...');
			
			// Convert threats to proper Pokemon objects for ranking
			var threatTeam = threats.map(function(threat, index){
				// Create a new Pokemon object from the species data
				var pokemon = new Pokemon(threat.speciesId, index, battle);
				pokemon.initialize(battle.getCP());
				return pokemon;
			});
			
			// Get current format settings
			var cup = battle.getCup();
			var cp = battle.getCP();
			
			// Use RankerMaster to find Pokemon that do well against this team of threats
			var ranker = RankerMaster.getInstance();
			var result = ranker.rank(threatTeam, cp, cup, [], "overall");
			
			// Extract the rankings array from the result object
			var rankings = result.rankings;
			
			// Sort by score (descending order - best counters first)
			rankings.sort(function(a, b) {
				return b.score - a.score;
			});
			
			// Get the selected number of counters from dropdown
			var counterCount = parseInt($('#counter-count').val());
			var topCounters = rankings.slice(0, counterCount);
			
			// Display the counters
			displayCounters(topCounters, battle, gm);
		}
		
		// Function to display counters (console only for now)
		function displayCounters(counters, battle, gm){
			// Store counters globally
			calculatedCounters = counters;
			
			var counterCount = counters.length;
			console.log('=== TOP ' + counterCount + ' COUNTERS (LIST 2) ===');
			counters.forEach(function(counter, index){
				console.log((index + 1) + '. ' + counter.speciesName + ' (Score: ' + Math.round(counter.score) + ')');
			});
			console.log('=== END LIST 2 ===');
			
			// Show the matrix battle section if we have both lists
			if(calculatedThreats.length > 0 && calculatedCounters.length > 0) {
				populateMatrix(calculatedThreats, calculatedCounters, battle, gm);
				$('.matrix-battle-section').show();
			}
		}
	});
	
	// Matrix battle functionality
	var matrixMultiSelect1;  // Left column (counters - List 2)
	var matrixMultiSelect2;  // Right column (threats - List 1)
	
	function populateMatrix(threats, counters, battle, gm) {
		// Initialize matrix PokeMultiSelect instances if not already done
		if (!matrixMultiSelect1 || !matrixMultiSelect2) {
			// Use the existing battle object instead of creating a new one
			// Get the two pokemultiselect containers within the matrix section
			var matrixContainers = $('.matrix-battle-section .poke.multi');
			
			if (matrixContainers.length >= 2) {
				// Left column = counters (List 2)
				matrixMultiSelect1 = new PokeMultiSelect($(matrixContainers[0]));
				matrixMultiSelect1.init(gm.data.pokemon, battle);
				
				// Make sure the container is visible and has proper structure
				$(matrixContainers[0]).show();
				
				// Right column = threats (List 1)  
				matrixMultiSelect2 = new PokeMultiSelect($(matrixContainers[1]));
				matrixMultiSelect2.init(gm.data.pokemon, battle);
				
				// Make sure the container is visible and has proper structure
				$(matrixContainers[1]).show();
				
			} else {
				console.error('Not enough matrix containers found:', matrixContainers.length);
				console.log('Available containers in matrix section:', $('.matrix-battle-section .poke'));
			}
		} else {
			console.log('Matrix PokeMultiSelect instances already exist');
		}
		
		// Get CP limit for optimization
		var cpLimit = battle.getCP();
		
		// Convert ranking data to the format expected by quickFillGroup with optimized stats
		var counterData = counters.map(function(counter) {
			// Create temporary Pokemon object to get optimized stats
			var tempPokemon = new Pokemon(counter.speciesId, 0, battle);
			tempPokemon.isCustom = false;
			tempPokemon.maximizeStat("overall", cpLimit);
			
			var data = {
				speciesId: counter.speciesId,
				ivs: [tempPokemon.ivs.atk, tempPokemon.ivs.def, tempPokemon.ivs.hp],
				level: tempPokemon.level
			};
			
			// Extract move IDs from moveset if available
			if (counter.moveset && counter.moveset.fastMove) {
				data.fastMove = counter.moveset.fastMove.moveId;
			}
			if (counter.moveset && counter.moveset.chargedMoves) {
				data.chargedMoves = counter.moveset.chargedMoves.map(function(move) {
					return move.moveId;
				});
			}
			
			return data;
		});
		
		var threatData = threats.map(function(threat) {
			// Create temporary Pokemon object to get optimized stats
			var tempPokemon = new Pokemon(threat.speciesId, 0, battle);
			tempPokemon.isCustom = false;
			tempPokemon.maximizeStat("overall", cpLimit);
			
			var data = {
				speciesId: threat.speciesId,
				ivs: [tempPokemon.ivs.atk, tempPokemon.ivs.def, tempPokemon.ivs.hp],
				level: tempPokemon.level
			};
			
			// Extract move IDs from moveset if available
			if (threat.moveset && threat.moveset.fastMove) {
				data.fastMove = threat.moveset.fastMove.moveId;
			}
			if (threat.moveset && threat.moveset.chargedMoves) {
				data.chargedMoves = threat.moveset.chargedMoves.map(function(move) {
					return move.moveId;
				});
			}
			
			return data;
		});
		
		try {
			matrixMultiSelect1.quickFillGroup(counterData);  // Left column = counters (List 2)
			matrixMultiSelect1.updateListDisplay();
			
			// Debug: Check if content was actually added to the DOM
			var container1 = $(matrixContainers[0]).find('.rankings-container');
		} catch (error) {
			console.error('Error populating matrix 1:', error);
		}
		
		try {
			matrixMultiSelect2.quickFillGroup(threatData);   // Right column = threats (List 1)
			matrixMultiSelect2.updateListDisplay();
			
			// Debug: Check if content was actually added to the DOM
			var container2 = $(matrixContainers[1]).find('.rankings-container');
		} catch (error) {
			console.error('Error populating matrix 2:', error);
		}
		
	}
	
	$('.matrix-battle-btn').click(function() {
		if(!matrixMultiSelect1 || !matrixMultiSelect2 || 
		   matrixMultiSelect1.getPokemonList().length === 0 || 
		   matrixMultiSelect2.getPokemonList().length === 0) {
			alert('Please build your team first to generate the matrix.');
			return;
		}
		
		console.log('Starting matrix battle calculation...');
		generateMatrixBattle();
	});
	
	// Global variable to store matrix data for sorting
	var matrixRowData = [];

	function generateMatrixBattle() {
		// Get Pokemon lists from the PokeMultiSelect instances
		var counterPokemon = matrixMultiSelect1.getPokemonList();  // Left column
		var threatPokemon = matrixMultiSelect2.getPokemonList();   // Right column
		
		// Get shield settings from both PokeMultiSelect instances
		var counterSettings = matrixMultiSelect1.getSettings();
		var threatSettings = matrixMultiSelect2.getSettings();
		var counterShields = counterSettings.shields;
		var threatShields = threatSettings.shields;
		
		console.log('Matrix battle shields: Counters=' + counterShields + ', Threats=' + threatShields);
		
		// Clear previous matrix data
		matrixRowData = [];
		
		// Initialize all Pokemon with optimal IVs for Great League (1500 CP)
		var cpLimit = 1500;
		
		console.log('Optimizing Pokemon stats for CP limit:', cpLimit);
		
		// Initialize threat Pokemon with optimal IV spreads
		threatPokemon.forEach(function(pokemon) {
			// Reset custom flag and use maximizeStat instead of initialize
			pokemon.isCustom = false;
			pokemon.maximizeStat("overall", cpLimit);
			// console.log(pokemon.speciesName + ' optimized: Level ' + pokemon.level + 
			// 			', IVs: ' + pokemon.ivs.atk + '/' + pokemon.ivs.def + '/' + pokemon.ivs.hp + 
			// 			', CP: ' + pokemon.cp);
		});
		
		// Initialize counter Pokemon with optimal IV spreads  
		counterPokemon.forEach(function(pokemon) {
			// Reset custom flag and use maximizeStat instead of initialize
			pokemon.isCustom = false;
			pokemon.maximizeStat("overall", cpLimit);
			// console.log(pokemon.speciesName + ' optimized: Level ' + pokemon.level + 
			// 			', IVs: ' + pokemon.ivs.atk + '/' + pokemon.ivs.def + '/' + pokemon.ivs.hp + 
			// 			', CP: ' + pokemon.cp);
		});
		
		var totalBattles = threatPokemon.length * counterPokemon.length;
		var completedBattles = 0;
		
		console.log('Running ' + totalBattles + ' battles with optimized Pokemon...');
		
		// Create matrix results table using PvPoke Matrix Battle styling
		var matrixHtml = '<table class="rating-table matrix-table" cellspacing="0"><thead><tr><th class="arrow"></th>';
		
		// Header row with threat names (columns)
		threatPokemon.forEach(function(threat) {
			matrixHtml += '<th class="name">' + threat.speciesName + '<span>' + threat.cp + ' CP</span></th>';
		});
		
		// Add W/L/D and Average rating column headers
		matrixHtml += '<th class="record">W/L/D</th>';
		matrixHtml += '<th class="average">Avg</th>';
		matrixHtml += '</tr></thead><tbody>';
		
		// Battle each counter (rows) against each threat (columns)
		counterPokemon.forEach(function(counter, counterIndex) {
			// Track statistics for this counter
			var wins = 0, losses = 0, draws = 0;
			var totalRating = 0;
			var battleCount = 0;
			var battleRatings = []; // Store individual ratings for standard deviation calculation
			var battleResults = []; // Store HTML for each battle cell
			
			threatPokemon.forEach(function(threat, threatIndex) {
				// Run the battle with proper setup
				var b = new Battle();
				
				// Set up battle parameters  
				b.setCP(cpLimit); // Use the same CP limit as Pokemon initialization
				b.setCup("all");
				b.setBuffChanceModifier(0);
				
				// Set Pokemon and ensure they have movesets
				b.setNewPokemon(counter, 0, false);
				b.setNewPokemon(threat, 1, false);
				
				// Make sure Pokemon have movesets
				if(!counter.fastMove) {
					counter.autoSelectMoves();
				}
				if(!threat.fastMove) {
					threat.autoSelectMoves();
				}
				
				// Set shields based on PokeMultiSelect settings
				counter.setShields(counterShields);
				threat.setShields(threatShields);
				
				// Run simulation
				b.simulate();
				
				// Calculate rating properly
				var pokemon = b.getPokemon();
				var rating;
				
				if(pokemon[0].battleStats && pokemon[0].battleStats.rating !== undefined) {
					rating = Math.round(pokemon[0].battleStats.rating);
				} else {
					// Calculate rating manually if battleStats not available
					var healthRating = (pokemon[0].hp / pokemon[0].stats.hp);
					var damageRating = ((pokemon[1].stats.hp - pokemon[1].hp) / pokemon[1].stats.hp);
					rating = Math.floor((healthRating + damageRating) * 500);
				}
				
				// Track statistics
				totalRating += rating;
				battleCount++;
				battleRatings.push(rating); // Store for standard deviation calculation
				
				if(rating > 500) {
					wins++;
				} else if(rating == 500) {
					draws++;
				} else {
					losses++;
				}
				
				// Debug first battle only
				if(counterIndex === 0 && threatIndex === 0) {
					console.log('First battle debug:', {
						counter: counter.speciesName,
						threat: threat.speciesName,
						counterHP: pokemon[0].hp + '/' + pokemon[0].stats.hp,
						threatHP: pokemon[1].hp + '/' + pokemon[1].stats.hp,
						rating: rating
					});
				}
				
				var cellClass = b.getRatingClass(rating);
				battleResults.push('<td><a class="rating ' + cellClass + '" href="#"><span></span>' + rating + '</a></td>');
				completedBattles++;
			});
			
			// Calculate statistics for sorting
			var avgRating = battleCount > 0 ? Math.round(totalRating / battleCount) : 0;
			var stdDev = 0;
			if(battleRatings.length > 1) {
				var variance = battleRatings.reduce(function(sum, rating) {
					return sum + Math.pow(rating - avgRating, 2);
				}, 0) / battleRatings.length;
				stdDev = Math.sqrt(variance);
			}
			
			// Store row data for sorting
			matrixRowData.push({
				counter: counter,
				counterIndex: counterIndex,
				battleResults: battleResults,
				wins: wins,
				losses: losses,
				draws: draws,
				avgRating: avgRating,
				stdDev: stdDev,
				originalIndex: counterIndex
			});
		});
		
		// Build and display the matrix table
		buildMatrixTable(threatPokemon, 'none');
		$('.matrix-results').show();
		
		console.log('Matrix battle completed! ' + completedBattles + ' battles calculated.');
	}

	// Function to build and display the matrix table with sorting
	function buildMatrixTable(threatPokemon, sortBy) {
		// Make a copy of the data to sort
		var sortedData = matrixRowData.slice();
		
		// Sort the data based on the selected option
		switch(sortBy) {
			case 'average':
				sortedData.sort(function(a, b) { return b.avgRating - a.avgRating; });
				break;
			case 'wins':
				sortedData.sort(function(a, b) { return b.wins - a.wins; });
				break;
			case 'flexibility':
				// Lower standard deviation = more flexible (consistent performance)
				sortedData.sort(function(a, b) { return a.stdDev - b.stdDev; });
				break;
			case 'none':
			default:
				// Keep original order (sort by originalIndex)
				sortedData.sort(function(a, b) { return a.originalIndex - b.originalIndex; });
				break;
		}
		
		// Build HTML with header
		var matrixHtml = '<table class="rating-table matrix-table" cellspacing="0"><thead><tr><th class="arrow"></th>';
		
		// Header row with threat names (columns)
		threatPokemon.forEach(function(threat) {
			matrixHtml += '<th class="name">' + threat.speciesName + '<span>' + threat.cp + ' CP</span></th>';
		});
		
		// Add W/L/D and Average rating column headers
		matrixHtml += '<th class="record">W/L/D</th>';
		matrixHtml += '<th class="average">Avg</th>';
		matrixHtml += '</tr></thead><tbody>';
		
		// Build rows with sorted data
		sortedData.forEach(function(rowData) {
			var row = '<tr><td class="name">' + rowData.counter.speciesName + '<div class="name-small">' + rowData.counter.cp + ' CP</div></td>';
			
			// Add battle results
			row += rowData.battleResults.join('');
			
			// Add W/L/D record column
			var recordText = rowData.wins + '/' + rowData.losses + '/' + rowData.draws;
			row += '<td class="record-cell">' + recordText + '</td>';
			
			// Add average rating column
			var tempBattle = new Battle();
			var avgClass = tempBattle.getRatingClass(rowData.avgRating);
			row += '<td class="average-cell"><a class="rating ' + avgClass + '" href="#"><span></span>' + rowData.avgRating + '</a></td>';
			
			row += '</tr>';
			matrixHtml += row;
		});
		
		matrixHtml += '</tbody></table>';
		
		// Display results with proper table container styling
		$('.matrix-results .matrix-container').html('<div class="table-container">' + matrixHtml + '</div>');
	}

	// Add sort dropdown change handler
	$('#matrix-sort-select').on('change', function() {
		var sortBy = $(this).val();
		var threatPokemon = matrixMultiSelect2.getPokemonList();
		buildMatrixTable(threatPokemon, sortBy);
	});
</script>

<script src="<?php echo $WEB_ROOT; ?>js/Main.js?v=3"></script>

<?php require_once 'footer.php'; ?>