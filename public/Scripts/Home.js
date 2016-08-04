$(document).ready(function () {
	{
		$.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		})
    	QuestionSheet = {Title: null, Desc: null, Qs: []};
    	var colorlist = ["#3c763d", "#FFCE56", "#36A2EB", "#FF6384", "#E7E9ED", "#4BC0C0"];
    	//QuestionSheet.Qs[] = { Q: null, Type: null, Ans: []}
	}
	//General Functions
    {
        partialNav = function (div, url, title) {
            $('.marching-ants.marching.bnw').removeClass("marching-ants marching bnw");
            $('.preloader').fadeOut();
            try {
                window.stop();
            }
            catch (e) {
                document.execCommand('Stop');
            }

            $(div).html('<div id="progress_report"><div class="loading-effect-2"><span></span></div></div>');


            if (url.indexOf("?") == -1)
                url += "?cachCtrl=" + Date.now();
            else
                url += "&cachCtrl=" + Date.now();

            $(div).load(url, function () {
                $(div).removeClass("marching-ants marching bnw");
                if(title != null)
                	$('#header').html(title);
            });
            $(div).addClass("marching-ants marching bnw");
        }

        var keyStop = {
		   8: ":not(input:text, textarea, input:file, input:password)", // stop backspace = back
		   13: "input:text, input:password", // stop enter = submit 

		   end: null
		 };
		 $(document).bind("keydown", function(event){
		  var selector = keyStop[event.which];

		  if(selector !== undefined && $(event.target).is(selector)) {
		      event.preventDefault(); //stop event
		  }
		  return true;
		 });
    }

    //Question Generator
    {
    	//Question
    	{
	    	startQ_Create = function(){
	    		$('#questions').html('');
	    		Add_NewQues();
	    	}

	    	QCreate_Next = function(qnum){
	    		if(qnum == QuestionSheet.Qs.length){
	    			QuestionSheet.Qs[qnum] = { Q: null, Type: null, Ans: []};
					 $('#question_' + qnum + ' select').fadeIn();
	    			Add_NewQues();
	    		}
	    	}

	    	Remove_Ques = function(qnum){
	    		var tempQ = QuestionSheet.Qs, a = 0;

	    		QuestionSheet.Qs = [];

	    		for (var i = 0; i < tempQ.length; i++) {
	    			if(qnum == i)
	    				continue;
	    			QuestionSheet.Qs[a] = tempQ[i];
	    			a++;
	    		}
	    		rebuildForm();
	    	}

	    	SaveQue = function(qnum){
	    		if(qnum < QuestionSheet.Qs.length && $('#question_' + qnum + ' input.question').val() == ''){
	    			Remove_Ques(qnum);
	    			return false;
	    		}
	    		QuestionSheet.Qs[qnum] = { Q: $('#question_' + qnum + ' input.question').val(), Type: $('#question_' + qnum + ' select').val(), Ans: []};
	    		
	    		switch($('#question_' + qnum + ' select').val()){
	    			case '3':
	    				break;
					case '4':
	    				break;
					default:
						QuestionSheet.Qs[qnum].Ans = [];
						break;
	    		}
	    	}

	    	Add_NewQues = function(){
	    		var qnum = QuestionSheet.Qs.length;
	    		var qs = '<div id="question_' + qnum + '">';
	    		qs +='<div class="form-group col-xs-8">';
	        	qs +='<input class="form-control question" name="question[]" placeholder="Question ' + (qnum + 1) + '" type="text" onchange="SaveQue(' + qnum + ')" onkeyup="QCreate_Next(' + qnum + ')">';
	        	qs +='</div><div class="form-group col-xs-4"><select class="form-control" onchange="initOptions(' + qnum + ')" style="display: none;"><option value="1"> Text Answer </option><option value="2"> Numeric Answer </option><option value="3"> Single choice </option><option value="4"> Multiple choice </option></select></div>';
	        	qs +='<div class="options"><div></div>';
	    		$('#questions').append(qs);
	    	}

	    	rebuildForm = function(){
	    		$('#questions').html('');
	    		for (var i = 0; i < QuestionSheet.Qs.length; i++) {
	    			var qs = '<div id="question_' + i + '">';
		    		qs +='<div class="form-group col-xs-8">';
		        	qs +='<input class="form-control question" value="' + QuestionSheet.Qs[i].Q + '" name="question[]" placeholder="Question ' + (i + 1) + '" type="text" onchange="SaveQue(' + i + ')" onkeyup="QCreate_Next(' + i + ')">';
		        	qs +='</div><div class="form-group col-xs-4"><select class="form-control" onchange="initOptions(' + i + ')">'
		        	alert(QuestionSheet.Qs[i].Type);
		        	switch(QuestionSheet.Qs[i].Type){
		        		case '1':
		        			qs +='<option value="1" selected> Text Answer </option><option value="2"> Numeric Answer </option><option value="3"> Single choice </option><option value="4"> Multiple choice </option>';
		        			break;
	        			case '2':
	        				qs +='<option value="1"> Text Answer </option><option value="2" selected> Numeric Answer </option><option value="3"> Single choice </option><option value="4"> Multiple choice </option>';
		        			break;
	        			case '3':
	        				qs +='<option value="1"> Text Answer </option><option value="2"> Numeric Answer </option><option value="3" selected> Single choice </option><option value="4"> Multiple choice </option>';
		        			break;
	        			default:
				        	qs +='<option value="1"> Text Answer </option><option value="2"> Numeric Answer </option><option value="3"> Single choice </option><option value="4" selected> Multiple choice </option>';
		        			break;
		        	}
		        	qs +='</select></div>';
		        	qs +='<div class="options">';

		        	for (var a = 0; a < QuestionSheet.Qs[i].Ans.length; a++) {
		        		qs +='<div class="form-group col-xs-10"><input class="form-control option" value="' + QuestionSheet.Qs[i].Ans[a] + '" placeholder="Option ' + (a  + 1) + '" type="text" onchange="SaveOpt(' + i + ', ' + a + ')"></div>';
		        	}
		        	if(QuestionSheet.Qs[i].Type > 2)
		        		qs +='<div class="form-group col-xs-10"><input class="form-control option" placeholder="Option ' + (QuestionSheet.Qs[i].Ans.length + 1) + '" type="text" onchange="SaveOpt(' + i + ', ' + QuestionSheet.Qs[i].Ans.length + ')"></div>';
		        	'<div></div>';
		        	$('#questions').append(qs);
	    		}

	    		Add_NewQues();
	    	}
	    }
    	//Options
    	{
    		initOptions = function(qnum){
    			var ops = '';
    			switch($('#question_' + qnum + ' select').val()){
	    			case '3':
					case '4':
					ops +='<div class="form-group col-xs-10"><input class="form-control option" placeholder="Option 1" type="text" onchange="SaveOpt(' + qnum + ', 0)"></div>';
					$('#questions #question_' + qnum + ' .options').html(ops);
	    				break;
					default:
						QuestionSheet.Qs[qnum].Ans = [];
						$('#questions #question_' + qnum + ' .options').html('');
						break;
	    		}

	    		QuestionSheet.Qs[qnum].Type = $('#question_' + qnum + ' select').val();
    		}

    		SaveOpt = function(qnum, opnum){
    			var opts = $('#questions #question_' + qnum + ' .options .option'), a = 0;
    			QuestionSheet.Qs[qnum].Ans = [];
    			for (var i = 0; i < opts.length; i++) {
    				if($(opts[i]).val() == ''){
    					continue;
    				}
	    			QuestionSheet.Qs[qnum].Ans[a] = $(opts[i]).val();
	    			a++;
    			}
	    		if(opnum == (QuestionSheet.Qs[qnum].Ans.length - 1) && QuestionSheet.Qs[qnum].Ans[opts] == ''){
	    			Add_NewOption(qnum);
	    		}
	    	}

    		Add_NewOption = function(qnum){
    			var opnum = QuestionSheet.Qs[qnum].Ans.length;
	    		var ops = '<div class="form-group col-xs-10">';
	    		ops +='<input class="form-control option" placeholder="Option ' + (opnum  + 1) + '" type="text" onchange="SaveOpt(' + qnum + ', ' + opnum + ')"></div>';
	    		$('#questions #question_' + qnum + ' .options').append(ops);
	    	}
    	}
    	//Save Form
    	{
    		SaveNewForm = function(){
    			QuestionSheet.Title = $('#FormTitle').val();
    			QuestionSheet.Desc = $('#FormDesc').val();
    			$.ajax({
				    type: "POST",
				    url: "SaveSheet",
				    data: {data: QuestionSheet},
				    success: function(id){
				    	partialNav('#MainWindow', 'home_', 'Home');		    	
				    },
				    error: function(){
				    	alert("Error Adding form");
				    }
				});
    			return false;
    		}
    	}
    }

    //TakeSurvey
    {
    	SaveSurv = function(){
    		var AnswerSheet = {FormID: $('#FormSheetID').val(), QAs: []};
    		var AllQs = $('.question');
    		for (var i = AllQs.length - 1; i >= 0; i--) {
    			switch($(AllQs[i]).attr('ty')){
    				case '3':
    					AnswerSheet.QAs[i] = {Ty: $(AllQs[i]).attr('ty'), QiD: $(AllQs[i]).attr('qid'), Ans: $("input[type='radio'][name='Qin_" + $(AllQs[i]).attr('qid') + "']:checked").val()};
	    				break;
					case '4':
						var chekd = $("input[type='checkbox'].Qin_" + $(AllQs[i]).attr('qid') + ":checked");
						AnswerSheet.QAs[i] = {Ty: $(AllQs[i]).attr('ty'), QiD: $(AllQs[i]).attr('qid'), Ans: ''};
						for (var a = chekd.length - 1; a >= 0; a--) {
							AnswerSheet.QAs[i].Ans += ':|:'+ $(chekd[a]).val();
						}
						AnswerSheet.QAs[i].Ans = AnswerSheet.QAs[i].Ans.substring(3)
	    				break;
					default:
						AnswerSheet.QAs[i] = {Ty: $(AllQs[i]).attr('ty'), QiD: $(AllQs[i]).attr('qid'), Ans: $('input#Qin_' + $(AllQs[i]).attr('qid')).val()};
						break;
    			}
    		}

    		$.ajax({
				    type: "POST",
				    url: "SaveSuvr",
				    data: AnswerSheet,
				    success: function(id){
				    	partialNav('#MainWindow','SurvResults/' + AnswerSheet.FormID, null)
				    	//partialNav('#MainWindow', 'home_', 'Home');		    	
				    },
				    error: function(){
				    	alert("Error Sending Survey form");
				    }
				});
    		return false;
    	}
    }

    //Survey Res
    {
    	graphify = function(){
    		var graphb = $('li.graphb'), glables = [], datacnt = [];

    		for (var i = graphb.length - 1; i >= 0; i--) {
    			glables = $(graphb[i]).attr('opts').split(':|:');
    			datacnt = [];
    			for (var a = glables.length - 1; a >= 0; a--) {
    				datacnt[a] = occurrences($(graphb[i]).html(), glables[a], false);
    			}

	    		title = $($(graphb[i])).find('p').html();
	    		$($(graphb[i])).html('<canvas id="canv_' + $(graphb[i]).attr('qid') +'"></canvas>');
	    		$($(graphb[i])).fadeIn();
	    		display_chart(glables, datacnt, 'canv_' + $(graphb[i]).attr('qid'), title);
    		}
    	}

    	function occurrences(string, subString, allowOverlapping) {

		    string += "";
		    subString += "";
		    if (subString.length <= 0) return (string.length + 1);

		    var n = 0,
		        pos = 0,
		        step = allowOverlapping ? 1 : subString.length;

		    while (true) {
		        pos = string.indexOf(subString, pos);
		        if (pos >= 0) {
		            ++n;
		            pos += step;
		        } else break;
		    }
		    return n;
		}
    }

    //graph Functions
    {        
        display_chart = function (labels, data, place, title) {
            var ctx = document.getElementById(place);

            var data = {
                labels: labels,
                datasets: [
                    {
                        data: data,
                        backgroundColor: get_color_arr(data.length),
                        hoverBackgroundColor: get_color_arr(data.length)
                    }]
            };

            var myPieChart = new Chart(ctx, {
                type: 'doughnut',
                data: data,
                options: {
                    title: {
                        display: true,
                        text: title
                    },
                    legend: {
                        display: true,
                        position: 'bottom'
                    }
                }
            });
        }

        get_color_arr = function (len) {
            var col = [];
            for (i = 0; i < len; i++) {
                col[i] = colorlist[i % colorlist.length];
            }
            return col;
        }

    }

    //Manager
    {
    	deleteSheet = function (sheetID){
    		$.ajax({
				    type: "GET",
				    url: "DeleteSheet/" + sheetID,
				    success: function(id){
				    	partialNav('#MainWindow', 'home_', 'Home');		    	
				    },
				    error: function(){
				    	alert("Error Removing form");
				    }
				});
    	}
    }

    {
    	partialNav('#MainWindow', 'home_', 'Dashboard');
    }
});