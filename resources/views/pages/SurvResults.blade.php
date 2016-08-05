<div class="singleFormBox row">
    <div class="homeForms" onsubmit="return SaveSurv();" >

        <h4 class="text-muted"><center>{{ $FormSheet->FormSheetDesc }}</center></h4>
        <br/>
        <?php $currentQ = null; $totalCnt = 0; ?>
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

                    <?php $currentQ = $row->QuestID; $totalCnt++; ?>
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

                    <?php $currentQ = $row->QuestID; $totalCnt++; ?>
                @else
                    <li>{{ $row->SurvResText }}</li>
                @endif
            @endif
        @endforeach
        </ul></li>
        </ol>
        <br>
        <h3><center>Total number of respondents: <?php echo(sizeof($results) / $totalCnt++ )?> </center></h3>

    </div>
</div>
<script type="text/javascript">
    graphify();
</script>