<?php
include("pages/header.php");

function getHoneyOrganization($id)
{
    $query =
		  "SELECT pid, name_depth, nam_mo, caption FROM histlpu
          LEFT JOIN lpu ON histlpu.lpu = lpu.code
          LEFT JOIN т007 ON histlpu.subdiv = т007.depth and т007.code_mo = histlpu.lpu
          LEFT JOIN т001 ON т007.nom_podr = т001.nom_podr and т007.code_mo = т001.mcod
          WHERE histlpu.pid = $id AND histlpu.lpudx IS NULL ";
    return $query;
}


function searchByNameAndBth($condb,$searchFio, $bth)
{
	$fio = explode(" ", $searchFio);
	$query = "";
	if(count($fio) == 3)
			$query = "SELECT *, CASE
						WHEN (people.lpu is NULL) OR (people.lpudx is NOT NULL) THEN 'Гражданин не прикреплен'
							ELSE people.id
							END comment
							FROM people
						WHERE (fam = '$fio[0]' AND im = '$fio[1]' AND ot = '$fio[2]') AND dr = '$bth'";
		 
		else if(count($fio) == 2)
			$query = "SELECT *, CASE
						  WHEN (people.lpu is NULL) OR (people.lpudx is NOT NULL) THEN 'Гражданин не прикреплен'
								ELSE people.id
								END comment
								FROM people
						  WHERE (fam = '$fio[0]' AND im ='$fio[1]') AND dr = '$bth' ";
		
	
	$result = mysqli_query($condb,$query); 
	if(mysqli_num_rows($result) > 0)
		{
			while($row = mysqli_fetch_assoc($result))
			{ 
				$rValue = $row['comment'];
				if (is_numeric($row['comment']) == true)
				{
					
					$solve = mysqli_query($condb,getHoneyOrganization($rValue));
					while($elements = mysqli_fetch_assoc($solve))
					{
						echo "Гражданин прикреплен к ".$elements['caption']." ".$elements['name_depth']." ". $elements['nam_mo'];
					}
				}
				else echo "Гражданин не прикреплен";
			}
		}
		else echo "По запросу ничего не найдено ";

	
}

function searchByPolicy($condb, $enp)
{
	$query = "";
	$query = "SELECT *, CASE
				WHEN (people.lpu is NULL) OR (people.lpudx is NOT NULL) THEN 'Гражданин не прикреплен'
					ELSE people.id
					END comment
					FROM people
				WHERE (enp = '$enp') ";
				
	$result = mysqli_query($condb,$query); 
	if(mysqli_num_rows($result) > 0)
		{
			while($row = mysqli_fetch_assoc($result))
			{ 
				$rValue = $row['comment'];
				if (is_numeric($row['comment']) == true)
				{
					
					$solve = mysqli_query($condb,getHoneyOrganization($rValue));
					while($elements = mysqli_fetch_assoc($solve))
					{
						echo "Гражданин с таким полисом прикреплен к ".$elements['caption']." ".$elements['name_depth']." ". $elements['nam_mo'];
					}
				}
				else echo "Гражданин не прикреплен";
			}
		}
		else echo "Полис не найден ";	
		
}

if(isset($_POST['FIO'],$_POST['date'],$_POST['policy']))
	{
        $FIO = trim($_POST['FIO']);
		$policy = trim($_POST['policy']);
		
		$date_ = trim(str_replace('.', '-',$_POST['date']));
		$date = date('Y-m-d',strtotime($date_));
		
        $search = mysqli_real_escape_string($conn, $FIO);
		$date = mysqli_real_escape_string($conn, $date);
		$policy = mysqli_real_escape_string($conn, $policy);
		
		$fio = explode(" ", $FIO);
		
           ?>
		

<div id="search_result">
    <p>
		<?php 
				if (empty($_POST['FIO']) && empty($_POST['date']) && !empty($_POST['policy']))
				{
						echo searchByPolicy($conn,$policy);	
				}				
				else if (!empty($_POST['FIO']) && !empty($_POST['date']) && empty($_POST['policy'])) 
					{
						echo searchByNameAndBth($conn,$FIO,$date);
					}
				else echo "Введите ФИО и дату рождения либо полис";
		?>  	
    </p>
</div>
<?php
		}
		else
			{
				echo 'Вы должны вводить запросы в строки поиска.';
			}
?>


