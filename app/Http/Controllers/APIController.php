<?php

namespace App\Http\Controllers;

use Illuminate\Http\ReQuest;

use App\Http\ReQuests;

class APIController extends Controller
{
    public function home(){
    	$FormSheets = \DB::table('FormSheet')->get();
    	return view('pages.home', ['FormSheets' => $FormSheets]);
    }

    public function SaveSheet(ReQuest $reQuest){
    	$data = $reQuest->all();
    	$sheetID = \DB::table('FormSheet')->insertGetId(['FormSheetTitle' => $data['data']['Title'], 'FormSheetDesc' => $data['data']['Desc']]);

    	$qs = $data['data']['Qs'];
    	for ($i=0; $i < sizeof($qs); $i++) {
            if(trim($qs[$i]['Q']) == '')
                continue;
	    	if(isset($qs[$i]['Ans'])) {
	    		$quesID = \DB::table('Quest')->insertGetId(['QuestTypeID' => $qs[$i]['Type'], 'QuestText' => $qs[$i]['Q'], 'QuestOpts' => implode(':|:', $qs[$i]['Ans']), 'FormSheetID' => $sheetID]);
	    	}else{
    			$quesID = \DB::table('Quest')->insertGetId(['QuestTypeID' => $qs[$i]['Type'], 'QuestText' => $qs[$i]['Q'], 'FormSheetID' => $sheetID]);
	    	}
    	}
    	return json_encode(sizeof($qs));
    }

    public function DeleteSheet($id){
    	\DB::table('FormSheet')->where('FormSheetID', $id)->delete();
        \DB::table('Quest')->where('FormSheetID', $id)->delete();
        return $id;
    }

    public function TakeSurv($id){
        $FormSheet = \DB::table('FormSheet')->where('FormSheetID', $id)->first();
        $Quests = \DB::table('Quest')->where('FormSheetID', $id)->get();
        //return json_encode(['FormSheet' => $FormSheet, 'Quests' => $Quests]);
        return view('pages.TakeSurv', ['FormSheet' => $FormSheet, 'Quests' => $Quests]);
    }

    public function SaveSuvr(ReQuest $reQuest){
        $data = $reQuest->all();
        $QAs = $data['QAs'];
        for ($i=0; $i < sizeof($QAs); $i++) { 
            \DB::table('survres')->insert(['QuestID' => $QAs[$i]['QiD'], 'SurvResText' => $QAs[$i]['Ans']]);
        }

        return json_encode(1);
    }

     public function SurvResults($id){
        $FormSheet = \DB::table('FormSheet')->where('FormSheetID', $id)->first();
        $results = \DB::select('SELECT quest.QuestText, quest.QuestTypeID, quest.QuestOpts, survres.* FROM survres, formsheet, quest WHERE quest.QuestID = survres.QuestID and formsheet.FormSheetID = quest.FormSheetID and formsheet.FormSheetID = ?', [$id]);
        //return $results;
        return view('pages.SurvResults', ['FormSheet' => $FormSheet, 'results' => $results]);
    }
}
