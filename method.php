<?php  
	$arr1 = $_POST['arr1'];
	$arr2 = $_POST['arr2'];
	$method = $_POST['method'];

	if($method == "L1") {\
		manhattan($arr1, $arr2);
	}else if($method == "L2") {
		euclidean($arr1, $arr2);
	}else if($method == "L∞") {
		supremum($arr1, $arr2);
	}else if($method == "Cosine Similarity") {
		cs($arr1, $arr2);
	}


	function manhattan(array $arr1, array $arr2){ // L1
		$count = count($arr1);
        $res = 0;
        for ($i = 0; $i < $count; $i++) {
            $res += abs($arr1[$i] - $arr2[$i]);
        }
        echo $res;
	}

	function euclidean(array $arr1, array $arr2){ // L2
		$count = count($arr1);
        $res = 0;
        for ($i = 0; $i < $count; $i++) {
            $res += pow(($arr1[$i] - $arr2[$i]), 2);
        }
        $res = sqrt($res);
        echo $res;
	}

	function supremum(array $arr1, array $arr2){ // L∞
		$count = count($arr1);
        $res = array();
        for ($i = 0; $i < $count; $i++) {
            $res[$i] = abs($arr1[$i] - $arr2[$i]);
        }
        echo max($res);
	}
	
	function cs(array $arr1, array $arr2){ // Cosine Similarity
		$count = count($arr1);
        $res1 = 0;
        $res2 = 0;
        $res3 = 0;
        for ($i = 0; $i < $count; $i++) {
            $res1 += ($arr1[$i] * $arr2[$i]);
            $res2 += (pow($arr1[$i], 2));
            $res3 += (pow($arr2[$i], 2));
        }
        $res = ($res1 / (sqrt($res2) * sqrt($res3)));
        echo $res;
	}
?>