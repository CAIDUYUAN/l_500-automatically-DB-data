<?php
    include('./head.php');
    include('./db.php');

    $a = $_POST['text'];

    if($a == '' || $a == null ||  !is_numeric($a)){
        echo "<script>history.back();</script>";
    }else{

        

        //생서할 갯수 받음
        //$num = $_POST['text'];

        //성 배열 선언
        $familyname = array();
        $familyname = ['김','이','박','전','황','목','송','전','노','양','윤','고','최','조','백'];
        
        // 이름 배열 선언
        $lastname = array();
        $lastname = ['영중','유리','민후','유나','창인','기욱','해윤','미라','태진','혜진','미우'];

        //성별 배열 선언
        $gender = array();
        $gender = ['m','w'];

        //성공 횟수
        $success_num = 0;

        //실패 횟수
        $fail_num = 0;

        for($i = 1; $i <= $a; $i++){
            //랜덤으로 성의 인덱스 받음
            $familyname_rand = rand(0,count($familyname) -1);

            //랜덤으로 이름의 인덱스 받음
            $lastname_rand = rand(0,count($lastname) - 1);

            //랜덤으로 성별을 받음
            $gender_rand = $gender[rand(0,count($gender) -1)];

            //랜덤 비밀번호 생성
            $userpwd = sha1("abc".rand(1,1000));

            //랜덤 성+이름 합병
            $username = $familyname[$familyname_rand].$lastname[$lastname_rand];

            //랜덤 아이디 생성
            $userid = "abc".rand(1,9999999);

            //랜덤 이메일 생성
            $email = $userid.rand(1,9999999)."@gmail.com";

            //db 저장
            $sql = "INSERT INTO members(uid,pwd,name,gender,email,regtime) value";
            $sql .="('{$userid}','{$userpwd}','{$username}','{$gender_rand}','{$email}',now())";

            $result = $db->query($sql);

            if($result){
                $success_num++;
            }else{
                $fail_num++;
            }


        }

        $sql2 = "SELECT name,uid FROM members";
        $result2 = $db->query($sql2);

        $result2_num = $result2->num_rows;

        if($result2 != 0){
            for ($ii=0; $ii < $result2_num; $ii++) { 
                $result2_list = $result2->fetch_array(MYSQLI_ASSOC);
                echo "회원 이름 : " .$result2_list['name']. " , 회원 아이디: " .$result2_list['uid']. "<br />";
            }
            
        }else{
            echo "데이터가 존재 하지 않습니다.";
        }

        echo "입력 성공 수 {$success_num}";
        echo "<br />";
        echo "입력 실패 수 {$fail_num}";
    }
?>
