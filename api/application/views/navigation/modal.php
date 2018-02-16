 

                     <script type=text/ng-template id=myModalContent.html>
                                 <div class="modal-header">       
                            <h3 class="modal-title">I'm a modal!</h3>   
                            </div>       \n\
                            <div class="modal-body">              <ul>        
                            <li ng-repeat="item in modal.items">     
                            <a href="#" ng-click="$event.preventDefault(); modal.selected.item = item">{{ item }}</a>                </li>              </ul>              Selected: <b>{{ modal.selected.item }}</b>            </div>            <div class="modal-footer">      
                             
            <button class="btn btn-success btn-ef btn-ef-3 btn-ef-3c" ng-click="v()">
<i class="fa fa-arrow-right"></i> Submit\n\
</button>         
     <button class="btn btn-lightred btn-ef btn-ef-4 btn-ef-4c" ng-click="cancel()"><i class="fa fa-arrow-left"></i> Cancel</button>   
     
            </div>
                     
                     
                     </script>
                     
                     
                     <button type=button class="btn btn-theme btn-sm minotaur-btn" ng-click=ui.open()>Open me!</button>
                     
                     
                    <div  ng-controller="UiModalsController">
   <pre>Model: {{selected| json}}</pre>
   <input type="text" ng-model="selected" typeahead="item as item.CustomerName for item in Customer | filter:$viewValue | limitTo:5" 
         typeahead-min-length="2" typeahead-wa it-ms="1" typeahead-on-select='onSelect($item, $model, $label)' 
         typeahead-input-formatter="formatInput($model)" >
