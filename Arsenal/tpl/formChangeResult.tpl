<form method="post">
	Город: <input class="changeInputLink" name="tourney" value="{DATA_RESULT->TOURNEY}" required/><br/>
	Фирма: <input class="changeInputLink" type="text" name="team" value="{DATA_RESULT->TEAM}"required /><br />
	Количество филиалов: <input class="changeInputLink" name="num_games" value="{DATA_RESULT->NUM_GAMES}" required /><br />
	Количество наименований: <input class="changeInputLink" name="num_points" value="{DATA_RESULT->NUM_POINTS}" required /><br />
	<input class="changeButton" type="submit" name="submit" value="Сохранить" />
</form>
