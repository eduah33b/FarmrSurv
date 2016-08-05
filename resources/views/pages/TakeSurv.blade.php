<div class="singleFormBox row">
    <form class="homeForms" onsubmit="return SaveSurv();" >

        <p class="text-muted"><center>{{ $FormSheet->FormSheetDesc }}</center></p>
        <input type="hidden" name="FormSheetID" id="FormSheetID" value="{{ $FormSheet->FormSheetID }}">
        <br/>
        <?php $n = 1; ?>
        @foreach ($Quests as $Quest)
        
            @if ($Quest->QuestTypeID === 1)
                <div class="form-group col-sm-12 question" id="q_{{ $Quest->QuestID }}" ty="1" qid="{{ $Quest->QuestID }}">
                    <label class="control-label" for="Qin_{{ $Quest->QuestID }}">{{ $n++ }}. {{ $Quest->QuestText }}</label>
                    <input type="text" name="Qin_{{ $Quest->QuestID }}" id="Qin_{{ $Quest->QuestID }}" class="form-control" required/>
                </div>
            @elseif ($Quest->QuestTypeID === 2)
                <div class="form-group col-sm-12 question" id="q_{{ $Quest->QuestID }}" ty='2' qid="{{ $Quest->QuestID }}">
                    <label class="control-label" for="Qin_{{ $Quest->QuestID }}">{{ $n++ }}. {{ $Quest->QuestText }}</label>
                    <input type="number" name="Qin_{{ $Quest->QuestID }}" id="Qin_{{ $Quest->QuestID }}" class="form-control" required />
                </div>
            @elseif ($Quest->QuestTypeID === 3)
                <div class="form-group col-sm-12 question" id="q_{{ $Quest->QuestID }}" ty="3" qid="{{ $Quest->QuestID }}">
                    <label class="control-label">{{ $n++ }}. {{ $Quest->QuestText }}</label>
                    @foreach(explode(':|:', $Quest->QuestOpts) as $opt) 
                        <div class="radio">
                            <label>
                                <input type="radio" name="Qin_{{ $Quest->QuestID }}" class="Qin_{{ $Quest->QuestID }}" value="{{ $opt }}" required > {{ $opt }}
                            </label>
                            </div>
                      @endforeach
                </div>
            @else
                <div class="form-group col-sm-12 question" id="q_{{ $Quest->QuestID }}" ty="4" qid="{{ $Quest->QuestID }}">
                    <label class="control-label">{{ $n++ }}. {{ $Quest->QuestText }}</label>
                    @foreach(explode(':|:', $Quest->QuestOpts) as $opt) 
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="Qin_{{ $Quest->QuestID }}" class="Qin_{{ $Quest->QuestID }}" value="{{ $opt }}"> {{ $opt }}
                            </label>
                            </div>
                      @endforeach
                </div>
            @endif
        @endforeach
        
        <div class="form-group">
            <div class="col-sx-12">
                <input value="Done" class="btn btn-primary" type="submit">
            </div>
        </div>
    </form>
</div>