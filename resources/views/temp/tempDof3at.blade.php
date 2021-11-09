<div class="col-md-12" id="other_box" style="display: none">
    <div class="card">
        <div class="card-body">

    <div class="div">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                <label for="projectinput3">اختر الخزنة التي سيتم خصم المبلغ منها</label>
                <select class="select2-rtl form-control" data-placeholder="إختر الخزنة..." name="safe_id_not_paid">
                    <option></option>
                    @foreach ($safes2 as $safe)
                    <option value="{{$safe->id}}">{{$safe->safe_name}}</option>
                    @endforeach
                </select>
            </div>
            </div>
        </div>

    </div>




        </div>
    </div>
</div>
@if($purchaseOrder->payment_method == 'later')
<div class="col-md-12" id="later_box"   style="display: block"   >
    <div class="card">
        <div class="card-body">

    <div >
        <h4 class="form-section"><i class="la la-flag"></i> الدفعات <button onclick="addDofaa()" type="button" class="btn btn-success btn-sm"><i class="la la-plus"></i></button></h4>
        <div class="table-responsive">
        <table class="table table-bordered   table-hover" id="dofaaTable">
            <thead>
                <tr>
                    <th>المبلغ</th>
                    <th>تاريخ الإستحقاق</th>
                    <th>تم دفعها؟</th>
                </tr>
            </thead>
            <tbody>
                @if ($laterDates->isEmpty())
                <tr>
                    <th scope="row">
                        <div class="form-group">
                            <input type="number" id="" class="form-control" placeholder="أدخل المبلغ" name="later[1][amount]" value="0">
                        </div>
                    </th>
                    <td>
                        <fieldset class="form-group">
                        <input type="date" class="form-control" id="date"  name="later[1][date]" required>
                    </fieldset>
                    <fieldset class="form-group">
                        <div class="labrl">الملاحظات</div>
                        <textarea class="form-control" id="placeTextarea" rows="3" placeholder="مثال: الدفعه المقدمة" name="later[1][notes]"></textarea>
                    </fieldset>
                </td>

                    <td>
                        <fieldset class="checkboxsas">
                            <label>
                                دفع الان
                              <input type="checkbox" name="later[1][paynow]" onchange="return payNow(1)">
                            </label>
                        </fieldset>
                        <div class="form-group" style="display:none;" id="pay_now_1">
                            <label for="projectinput3">خصم من:</label>
                            <select class="select2-rtl form-control" data-placeholder="الخزنة" name="later[1][safe_id]" id="sel_xx_1">
                                <option></option>
                                @foreach ($safes as $safe)
                                <option value="{{$safe->id}}">{{$safe->safe_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </td>
                </tr>

                @else
                @foreach ($laterDates as $key2 => $item)
                <tr>
                    <th scope="row">
                        <div class="form-group">
                            <input type="number" id="" class="form-control" placeholder="أدخل المبلغ" name="later[{{$key2+1}}][amount]" value="{{$item->amount}}" @if($item->paid != 'No') readonly @endif>
                        </div>
                    </th>
                    <td>
                        <fieldset class="form-group">
                        <input type="date" class="form-control" id="date"   name="later[{{$key2+1}}][date]"  value="{{$item->date}}" @if($item->paid != 'No') readonly @endif>
                    </fieldset>
                    <fieldset class="form-group">
                        <div class="label">الملاحظات</div>
                        <textarea class="form-control" id="placeTextarea" rows="3" placeholder="مثال: الدفعه المقدمة" name="later[{{$key2+1}}][notes]" @if($item->paid != 'No') readonly @endif>{{$item->notes}}</textarea>
                    </fieldset>
                </td>

                    <td>
                        @if($item->paid != 'No')
                    <p class="text-success"> <input type="checkbox" name="later[{{$key2+1}}][paynow]" checked onclick="return false;"/> تم الدفع</p>
                    <p><label>رقم فاتورة الدفع: </label> {{$item->safe_payment_id}}</p>
                    <button class="btn btn-dark" type="button" onclick="return pay('{{route('safes.receipt',$item->safe_payment_id)}}');">استعراض الفاتورة</button>
                    <input type="hidden" id="" class="form-control" placeholder="رقم العملية في الخزنة" name="later[{{$key2+1}}][safe_payment_id]" value="{{$item->safe_payment_id}}">
                    <input type="hidden" name="later[{{$key2+1}}][safe_id]" value="{{$item->safe_id}}">
                        @else
                        <fieldset class="checkboxsas">
                            <label>
                                دفع الان
                              <input type="checkbox" name="later[{{$key2+1}}][paynow]" onchange="return payNow({{$key2+1}})">
                            </label>
                        </fieldset>
                        <div class="form-group" style="display:none;" id="pay_now_{{$key2+1}}">
                            <label for="projectinput3">خصم من:</label>
                            <select class="select2-rtl form-control" data-placeholder="الخزنة" name="later[{{$key2+1}}][safe_id]" id="sel_xx_{{$key2+1}}">
                                <option></option>
                                @foreach ($safes as $safe)
                                <option value="{{$safe->id}}">{{$safe->safe_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @endif




                        {{-- <fieldset class="checkboxsas">
                            <label>
                                مدفوعه
                              <input type="checkbox" name="later[{{$key2+1}}][paid]" @if($item->paid != 'No') checked  @endif onchange="return laterPaid({{$key2+1}})">
                            </label>
                        </fieldset> --}}


                        {{-- <div id="later_dates_{{$key2+1}}" @if($item->paid != 'No') style="display: block" @else style="display:none;"  @endif>
                        <div class="form-group">
                            <div class="label">رقم العملية في الخزنة:</div>
                            <input type="text" id="" class="form-control" placeholder="رقم العملية في الخزنة" name="later[{{$key2+1}}][safe_payment_id]" value="{{$item->safe_payment_id}}">
                        </div>
                        <div class="form-group">
                            <label for="projectinput3">خصمت من:</label>
                            <select class="select2-rtl form-control" data-placeholder="تعديل" name="later[{{$key2+1}}][safe_id]">
                                @if($item->paid  != 'No')
                                    @if($item->safe_id)
                                <option value="{{$item->safe_id}}">{{$item->safe->safe_name}}</option>
                                    @else
                                    <option></option>
                                    @endif
                                @else
                                <option></option>
                                @endif
                                @foreach ($safes as $safe)
                                <option value="{{$safe->id}}">{{$safe->safe_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        </div> --}}

                    </td>
                </tr>
                @endforeach
                @endif

            </tbody>
        </table>
        </div>
    </div>



        </div>
    </div>
</div>
@endif
