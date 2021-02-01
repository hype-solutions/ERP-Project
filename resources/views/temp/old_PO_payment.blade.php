<div class="col-md-8">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6" style="display: none">
                             <fieldset class="checkboxsas">
                                <label>
                                  <input type="checkbox" name="already_paid" id="hasPaid">
                                  هل تم دفع المبلغ بالكامل مسبقا؟
                                              </label>
                            </fieldset>

                        </div>
                        <div class="col-md-6" id="notPaid">
                            <div class="form-group">
                                {{-- <label class="text-warning">في حالة عدم الدفع المسبق للمبلغ بالكامل
                                    <br>
                                     برجاء اختيار طريقة الدفع و ادخال البيانات من هنا
                                    </label> --}}
                            <select class="form-control" id="payment_method" name="payment_method" required>
                                <option value="">إختر طريقة الدفع</option>
                                <option value="cash">كاش</option>
                                <option value="visa">فيزا</option>
                                <option value="later">اجل (دفعات)</option>
                                <option value="bankTransfer">تحويل بنكي</option>
                            </select>
                        </div>
                        </div>
                        <div class="col-md-6" style="display: none" id="yesPaid">
                            <div class="form-group">
                                <div class="label">رقم العملية في الخزنة</div>
                            {{-- <input type="text" class="form-control" name="safe_payment_id"/> --}}


                                <select class="select2-rtl form-control" data-placeholder="رقم العملية في الخزنة" name="safe_payment_id" id="safe_payment_id">
                                    <option></option>
                                    @foreach ($safe_payment_id as $payment)
                                    <option value="{{$payment->id}}">عملية رقم: {{$payment->id}} - {{$payment->transaction_notes}}</option>
                                    @endforeach
                                </select>
                              </div>
                        </div>

                        <div class="col-md-3" style="display: none" id="yesPaid2">
                            <div class="form-group">
                            <label for="projectinput3">خصمت من:</label>
                            <select class="select2-rtl form-control" data-placeholder="إختر الخزنة..." name="safe_id_if_paid">
                                <option></option>
                                @foreach ($safes as $safe)
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
                            @foreach ($safes as $safe)
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

        <div class="col-md-12" id="later_box" style="display: none">
            <div class="card">
                <div class="card-body">
                    <span class="text-danger" style="display: none" id="dof3aError">إجمالي الدفعات لا تساوي إجمالي المبلغ</span>
            <div >
                <h4 class="form-section"><i class="la la-flag"></i> الدفعات <button onclick="addDofaa()" type="button" class="btn btn-success btn-sm"><i class="la la-plus"></i></button></h4>
                <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dofaaTable">
                    <thead>
                        <tr>
                            <th>المبلغ</th>
                            <th>تاريخ الإستحقاق</th>
                            <th>تم دفعها؟</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">
                                <div class="form-group">
                                    <input type="number" id="" class="form-control dof3aSum" placeholder="أدخل المبلغ" name="later[1][amount]" value="0">
                                </div>
                            </th>
                            <td>
                                <fieldset class="form-group">
                                <input type="date" class="form-control" id="date"  name="later[1][date]">
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

                    </tbody>
                </table>
                </div>
            </div>



                </div>
            </div>
        </div>


    </div>
