<?php

class AnaClassController extends CommonController
{
    public function actionIndex()
    {
        $this->renderPartial('index');
    }	 
	/*
	 * 获取年级
	 */ 
    public function actionGetclass()
    {
    	$classtype 	= isset($_POST['ClassType'])?$_POST['ClassType']:'';
    	$schoolid	= isset($_POST['SchoolID'])?$_POST['SchoolID']:0;
    	
    	$this->layout = false;
        $result = array('success' => true, 'msg' => '');
        // 获取所有年级
        $gradeList = InfoGrade::model()->findAllByAttributes(array('SchoolID' => $schoolid, 'State' => 1));
        foreach ($gradeList as $gradeRecord)
        {
            $gradeInfo = array_change_key_case((array)$gradeRecord->getAttributes(), CASE_LOWER);
            $gradejson = array();
			$isfrist = 1;
            // 获取年级下的班级
            $classList = InfoClass::model()->findAllByAttributes(array('GradeID' => $gradeRecord->GradeID,'Type'=>$classtype ,'State' => 1));
            foreach ($classList as $classRecord)
            {
            	if($isfrist == 1)
	            	$gradejson = array(
		            	'id' => 'g-'.$gradeInfo["gradeid"],
			            'text'=> $gradeInfo["gradename"], 
			            'iconCls'=>"",
			            'children' => array());
	            	
            	$isfrist = 0;            
                $classInfo = array_change_key_case((array)$classRecord->getAttributes(), CASE_LOWER);
                $gradejson['children'][] = array(
                	'id' => $classInfo["classid"],
		            'text'=> $classInfo["classname"], 
		            'selected'=>false,
		            'iconCls'=>""
                );
            }
            if($isfrist == 0)
            	$result['data'][] = $gradejson;
        }
		
        $this->renderText(json_encode($result));
    	//iconCls 根据文理科配置成不一样的
    	/*
    	$s = '{
			  "success": true,
			  "msg": "",
			  "data": [
			    {
			      "id": "g-1",
			      "text": "高2014级",
			      "iconCls": "",
			      "children": [
			        {
			          "id": "1",
			          "text": "高2014级1班",
			          "selected": false,
			          "iconCls": ""
			        },
			        {
			          "id": "2",		          
			          "text": "高2014级2班",
			          "selected": false,
			          "iconCls": ""
			        }
			      ]
			    },
			    {
			      "id": "g-2",
			      "text": "高2015级",
			      "iconCls": "",
			      "children": [
			        {
			          "id": "3",		          
			          "text": "高2015级1班",
			          "selected": true,
			          "iconCls": ""
			        },
			        {
			          "id": "4",		          
			          "text": "高2015级2班",
			          "selected": false,
			          "iconCls": ""
			        }
			      ]
			    }
			  ]
			}';

        echo $s;*/
	}   
	/*
	 * 获取用户可选择科目
	 */ 
    public function actionGetsubject()
    {
    	$classtype 	= isset($_POST['ClassType'])?$_POST['ClassType']:'';
    	$schoolid	= isset($_POST['SchoolID'])?$_POST['SchoolID']:0;
    	$this->layout = false;
        $result = array('success' => true, 'msg'=>'', 'data' => array());
        
    	//查询科目
    	if(0 == $classtype)
    		$subjectList = InfoSubject::model()->findAll("(SchoolID = 0 OR SchoolID = :SchoolID) and State = 1",array('SchoolID'=>$schoolid));
        else 
    		$subjectList = InfoSubject::model()->findAll("(SchoolID = 0 OR SchoolID = :SchoolID) and (Type = ".$classtype." OR Type = 0) and State = 1",array('SchoolID'=>$schoolid));
        foreach ($subjectList as $subjectRecord)
    	{
    		$subjectInfo = array_change_key_case((array)$subjectRecord->getAttributes(), CASE_LOWER);
    		$subjectjson = array(
            	'id' => $subjectInfo["subjectid"],
	            'text'=> $subjectInfo["subjectname"], 
	            'selected'=>false
    		);
    		$result['data'][] = $subjectjson;
    	}
    	$this->renderText(json_encode($result));
    	/*
    	$s = '{
		  "success": true,
		  "msg": "",
		  "data": [
		    {
		      "id": "1",
		      "text": "语文",
		      "selected": true
		    },
		    {
		      "id": "2",
		      "text": "数学",
		      "selected": false
		    },
		    {
		      "id": "3",
		      "text": "英语",
		      "selected": false
		    }
		  ]
		}';

        echo $s;*/
	}   
	    
	/*
	 * 查询能力值
	 */ 
    public function actionGetyscore()
    {
    	$classids 	= isset($_POST['ClassIDs'])?$_POST['ClassIDs']:'';	
    	$SubjectID 	= isset($_POST['SubjectID'])?$_POST['SubjectID']:'';
    	
    	$this->layout = false;
        $result = array('success' => true, 'msg' => '');
        $isfrist = 1;
        $classidarr = explode(',',$classids);
        foreach ($classidarr as $classid)
        {
        	$recordclass = InfoClass::model()->findByPk($classid, "State = 1");
        	if (!empty($recordclass))
			{
	        	if($isfrist == 1)
	        	{
	        		$examdates	= array();
			    	$connection=Yii::app()->db; 
			    	$sql="select * from info_exam where gradeid = ".$recordclass['GradeID']."  
														and type = ".$recordclass['Type']."
														and state = 1
														order by examtime";
				//	echo $sql;
					$rows=$connection->createCommand ($sql)->query();
					foreach ($rows as $k => $v ){
						$examInfo = array_change_key_case($v, CASE_LOWER);
						$examdates[] = substr($examInfo['examtime'],0,10);
					}
			        $result['examdates'] = implode(",", $examdates);  
	        	}
        		$isfrist = 0;
        		$classInfo = array_change_key_case((array)$recordclass->getAttributes(), CASE_LOWER);
	        	$scorejson = array(
	            	'id' => $classInfo["classid"],
		            'name' => $classInfo["classname"]
		        );
		        
		        $connection=Yii::app()->db; 
				$sql="select es.*,e.examname,e.examtime from info_exam_class_yscore es,info_exam e where es.examid = e.examid and e.state = 1
					and es.classid = ".$classid." 
					and es.subjectid = ".$SubjectID." order by e.examtime";
				$rows=$connection->createCommand ($sql)->query();
				foreach ($rows as $k => $v ){
					$scoreInfo = array_change_key_case($v, CASE_LOWER);	
	        //		$scoreInfo = array_change_key_case((array)$recordScore->getAttributes(), CASE_LOWER);
	        		$scorejson[substr($scoreInfo["examtime"],0,10)] = $scoreInfo["examid"]."|".$scoreInfo["examname"]."|"
	        			.strval($scoreInfo["avgcyscore"])."|"
	        			.strval($scoreInfo["avgcyscorerank"])."|"
	        			.strval($scoreInfo["avgsta"])."|"
	        			.strval($scoreInfo["avgimp"]);
	        	}
	
	            $result['data'][] = array_change_key_case($scorejson, CASE_LOWER);
			}
        }
        $this->renderText(json_encode($result));
    	/*
    	 * examid|examname|能力值|排名|稳定性|进步值
    	 */
    	/*
        $s = '{
			  "success": true,
			  "msg": "",
			  "data": [
			    {
			      "id": "1",
			      "name": "1班",
			      "2013-09-01": "1|中考|84|7|0|0",
			      "2013-10-01": "2|第一次月考|89|9|16|4|7",
			      "2013-11-01": "3|半期考试|97|4|12|5|9",
			      "2013-12-01": "4|第三次月考|85|4|12|6|2"
			    },
			    {
			      "id": "2",
			      "name": "2班",
			      "2013-09-01": "1|中考|63|13|24|0|0",
			      "2013-10-01": "2|第一次月考|56|15|27|4|7",
			      "2013-11-01": "3|半期考试|82|24|43|5|9",
			      "2013-12-01": "4|第三次月考|71|34|52|6|2"
			    }
			  ],
			  "examdates": "2013-09-01,2013-10-01,2013-11-01,2013-12-01"
			}';
        echo $s;*/
	}	
		/*
	 * 查询考试详细能力值
	 */ 
    public function actionGetyscorebyexam()
    {
    	$classid 	= isset($_POST['UID'])?$_POST['UID']:'';	
    	$examIid 	= isset($_POST['ExamID'])?$_POST['ExamID']:'';
    	
    	$this->layout = false;
        $result = array('success' => true, 'msg' => '');
        //先查询考试总共的基础科目
        $subjectids	= array();
    	$connection=Yii::app()->db; 
		$sql="select vs.* from v_exam_subject vs,info_subject s where vs.examid = s.examid and vs.ExamID = ".$examid." and vs.state = 1 and s.ReferSubjectID = ''";
		$rows=$connection->createCommand ($sql)->query();
		foreach ($rows as $k => $v ){
			$subjectInfo = array_change_key_case($v, CASE_LOWER);
			$subjectids[] = $subjectInfo['subjectid'].'-'.$subjectInfo['subjectname'];
		}
        $result['subjectids'] = implode(",", $subjectids); 
         
    	//查询数值
    	$sql="select es.*,e.examname,e.examtime,s.classname from info_exam_yscore es,info_exam e,info_class s where es.examid = e.examid and s.classid = es.classid and e.state = 1
				and es.classid = ".$classid." 
				and es.examid = ".$examIid;
    	$rows=$connection->createCommand ($sql)->query();
    	$isfirst = 1;
		foreach ($rows as $k => $v ){
			$examInfo = array_change_key_case($v, CASE_LOWER);
			if($isfirst == 1)
				$scorejson = array(
	            	'id' => $examInfo["classid"].'-'.$examInfo["examid"],
		            'name' => $examInfo["classname"],
					'examname' => $examInfo["examname"],
					'examtime' => substr($examInfo["examtime"],0,10)
		        );
		    $isfirst = 0;
	        $scorejson['s'.$examInfo["subjectid"]] = $scoreInfo["cyscore"];
	        $scorejson['s'.$examInfo["subjectid"].'-cr'] = $scoreInfo["avgcyScorerank"];
	        $scorejson['s'.$examInfo["subjectid"].'-max'] = $scoreInfo["maxcyScore"];
	        $scorejson['s'.$examInfo["subjectid"].'-min'] = $scoreInfo["mincyScore"];	        
	        $scorejson['s'.$examInfo["subjectid"].'-s'] = $scoreInfo["avgsta"];
	        $scorejson['s'.$examInfo["subjectid"].'-s-max'] = $scoreInfo["maxsta"];
	        $scorejson['s'.$examInfo["subjectid"].'-s-min'] = $scoreInfo["minsta"];
	        $scorejson['s'.$examInfo["subjectid"].'-i'] = $scoreInfo["avgimp"];
	        $scorejson['s'.$examInfo["subjectid"].'-i-max'] = $scoreInfo["maximp"];
	        $scorejson['s'.$examInfo["subjectid"].'-i-min'] = $scoreInfo["minimp"];
		}    		
		$result['data'][] = array_change_key_case($scorejson, CASE_LOWER);
   /* 	$s = '';
    	if('1' == $uid)
	    	$s = '{
				  "success": true,
				  "msg": "",
				  "data": [
				    {
				      "id":"1-4",
				      "name": "1班",
				      "examname": "考试1",
				      "examtime": "2013-5-1",
				      "s1": "117-s1",
				      "s1-cr": 18,
				      "s1-gr": 27,
				      "s1-max": "117",
				      "s1-min": "117",
				      "s1-s": "3",
				      "s1-s-max": "3",
				      "s1-s-min": "3",
				      "s1-i": "3",
				      "s1-i-max": "3",
				      "s1-i-min": "3",
				      "s2": "127-s2",
				      "s2-cr": 17,
				      "s2-gr": 21,
				      "s2-max": "117",
				      "s2-min": "117",
				      "s2-s": "3",
				      "s2-s-max": "3",
				      "s2-s-min": "3",
				      "s2-i": "3",
				      "s2-i-max": "3",
				      "s2-i-min": "3",
				      "s3": "135-s3",
				      "s3-cr": 17,
				      "s3-gr": 21,
				      "s3-max": "117",
				      "s3-min": "117",
				      "s3-s": "3",
				      "s3-s-max": "3",
				      "s3-s-min": "3",
				      "s3-i": "3",
				      "s3-i-max": "3",
				      "s3-i-min": "3"
				    }
				  ],
				  "subjectids": "1-语文,2-数学,3-英语"
				}';
	    if('2' == $uid)
	    	$s = '{
				  "success": true,
				  "msg": "",
				  "data": [
				    {
				      "id":"2-4",
				      "name": "2班",
				      "examname": "考试1",
				      "examtime": "2013-5-1",
				      "s1": "117-s1",
				      "s1-cr": 18,
				      "s1-gr": 27,
				      "s1-max": "117",
				      "s1-min": "117",
				      "s1-s": "3",
				      "s1-s-max": "3",
				      "s1-s-min": "3",
				      "s1-i": "3",
				      "s1-i-max": "3",
				      "s1-i-min": "3",
				      "s2": "127-s2",
				      "s2-cr": 17,
				      "s2-gr": 21,
				      "s2-max": "117",
				      "s2-min": "117",
				      "s2-s": "3",
				      "s2-s-max": "3",
				      "s2-s-min": "3",
				      "s2-i": "3",
				      "s2-i-max": "3",
				      "s2-i-min": "3",
				      "s3": "135-s3",
				      "s3-cr": 17,
				      "s3-gr": 21,
				      "s3-max": "117",
				      "s3-min": "117",
				      "s3-s": "3",
				      "s3-s-max": "3",
				      "s3-s-min": "3",
				      "s3-i": "3",
				      "s3-i-max": "3",
				      "s3-i-min": "3"
				    }
				  ],
				  "subjectids": "1-语文,2-数学,3-英语"
				}';	
        echo $s;*/
    }
}