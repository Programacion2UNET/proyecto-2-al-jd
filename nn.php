<?php while ($row = mysql_fetch_array($res)){?>
						<option  value=""><?php $row['id'] ?></option>
					    <option  value=""><?php $row['id_torneo'] ?></option>					    
					    <option  value=""><?php $row['participantes'] ?></option>
					    <option  value=""><?php $row['categoria'] ?></option>
					    <?php} ?>