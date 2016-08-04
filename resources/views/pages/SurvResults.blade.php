<div class="singleFormBox row">
    <div class="homeForms" onsubmit="return SaveSurv();" >

        <p class="text-muted"><center>{{ $FormSheet->FormSheetDesc }}</center></p>
        <br/>
        <?php $currentQ = null; ?>
        <ol id="surveyRes">
        @foreach ($results as $row)
            @if ($row->QuestTypeID === 1 || $row->QuestTypeID === 2)
                @if($currentQ !== $row->QuestID)
                    @if($currentQ !== null)
                            </ul>
                        </li>
                    @endif
                    <li ty="{{ $row->QuestTypeID }}" id="QiD_{{ $row->QuestID }}" qid="{{ $row->QuestID }}">
                        <p>{{ $row->QuestText }}<p>
                        <ul>
                            <li>{{ $row->SurvResText }}</li>                        

                    <?php $currentQ = $row->QuestID; ?>
                @else
                    <li>{{ $row->SurvResText }}</li>
                @endif
            @else
               @if($currentQ !== $row->QuestID)
                    @if($currentQ !== null)
                            </ul>
                        </li>
                    @endif
                    <li ty="{{ $row->QuestTypeID }}" id="QiD_{{ $row->QuestID }}" qid="{{ $row->QuestID }}" class="graphb" opts="{{ $row->QuestOpts }}" style="display: none;">
                        <p>{{ $row->QuestText }}<p>
                        <ul>
                            <li>{{ $row->SurvResText }}</li>                        

                    <?php $currentQ = $row->QuestID; ?>
                @else
                    <li>{{ $row->SurvResText }}</li>
                @endif
            @endif
        @endforeach
        </ul></li>
        <ol>
    </div>
</div>
<script type="text/javascript">
    graphify();
</script>