<div class="card" style="display: none">
    <div class="card-content collapse show">
        <div class="card-body">

            <fieldset class="checkboxsas">
                <label>
                  <input type="checkbox" name="already_delivered" id="hasDelivered" >
                 هل تم الإستلام بالفعل؟
                              </label>
            </fieldset>
            <div class="div" id="delivery_info" style="display: none">
                <fieldset class="form-group">
                    <div class="label">تاريخ الإستلام</div>
                    <input type="date" class="form-control" id="delDate"  name="delivery_date">
                </fieldset>
                <div class="form-group">
                    <label> اختر الفرع (المخزن) المستلم:</label>


                    <select class="select2-rtl form-control" id="delBranch" data-placeholder="إختر الفرع..." name="branch_id">

                        <option></option>

                        @foreach ($branches as $branch)
                        <option value="{{$branch->id}}">{{$branch->branch_name}}</option>
                        @endforeach
                    </select>
                  </div>
            </div>
        </div>
    </div>
</div>
