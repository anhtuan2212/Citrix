 <!-- Modal Thêm thiết bị -->
 <div class="modal fade" id="exampleModalNhaKho" tabindex="-1" role="dialog" aria-labelledby="exampleModalSignTitle"
     aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-md" role="document">
         <div class="modal-content">
             <form id="form-equiment">
                 @csrf
                 <div class="modal-body">
                     <div class="row">
                         <div class="col-xl col-md col-sm">
                             <div>
                                 <div class="d-flex justify-content-between">
                                     <label>Tên thiết bị (<strong class="text-danger">*</strong>)</label>
                                     <label class="form-control-label text-danger" id="name-error"></label>
                                 </div>
                                 <input type="text" name="name" class="form-control">
                             </div>
                             <div class="mt-2">
                                 <div class="d-flex justify-content-between">
                                     <label>Ảnh thiết bị (<strong class="text-danger">*</strong>)</label>
                                     <label class="form-control-label text-danger" id="image-error"></label>
                                 </div>
                                 <input type="file" name="image" class="form-control">
                             </div>
                             <div class="mt-2">
                                 <div class="d-flex justify-content-between">
                                     <label>Thông số thiết bị (<strong class="text-danger">*</strong>)</label>
                                     <label class="form-control-label text-danger" id="specifications-error"></label>
                                 </div>
                                 <textarea class="form-control" id="specifications" name="specifications" cols="50" rows="3"></textarea>
                             </div>
                             <div class="mt-2">
                                 <div class="d-flex justify-content-between">
                                     <label>Giá nhập (<strong class="text-danger">*</strong>)</label>
                                     <label class="form-control-label text-danger" id="price-error"></label>
                                 </div>
                                 <input type="text" name="price" class="form-control">
                             </div>
                             <div class="mt-2">
                                 <div class="d-flex justify-content-between">
                                     <label>Ngày hết hạn (<strong class="text-danger">*</strong>)</label>
                                     <label class="form-control-label text-danger" id="out-date-error"></label>
                                 </div>
                                 <input type="date" name="out_of_date" class="form-control">
                             </div>
                             <div class="mt-2">
                                 <div class="d-flex justify-content-between">
                                     <label>Hạn bảo hành (<strong class="text-danger">*</strong>)</label>
                                     <label class="form-control-label text-danger" id="price-error"></label>
                                 </div>
                                 <input type="date" name="warranty_date" class="form-control">
                             </div>
                             <div class="mt-2">
                                 <div class="d-flex justify-content-between">
                                     <label>Loại sản phẩm (<strong class="text-danger">*</strong>)</label>
                                 </div>
                                 <select name="equiment_type_id" id="equiment_type_id" class="form-control">
                                     @foreach ($list_loai as $item)
                                         <option value="{{ $item->id }}">{{ $item->name }}</option>
                                     @endforeach
                                 </select>
                             </div>
                             <div class="mt-2">
                                 <div class="d-flex justify-content-between">
                                     <label>Nhà cung cấp (<strong class="text-danger">*</strong>)</label>
                                 </div>
                                 <select name="supplier_id" id="supplier_id" class="form-control">
                                     @foreach ($list_nha_cung_cap as $item)
                                         <option value="{{ $item->id }}">{{ $item->name }}</option>
                                     @endforeach
                                 </select>
                             </div>
                             <div id="divkho" class="mt-2">
                                 <div class="d-flex justify-content-between">
                                     <label>Kho (<strong class="text-danger">*</strong>)</label>
                                 </div>
                                 <select name="storehouse_id" class="form-control">
                                     @foreach ($list_kho as $item)
                                         <option value="{{ $item->id }}"><img src="{{ $item->image }}"
                                                 alt="">
                                             {{ $item->name }}</option>
                                     @endforeach
                                 </select>
                             </div>
                             <div id="divsoluong" class="mt-2">
                                 <div class="d-flex justify-content-between">
                                     <label>Số lượng (<strong class="text-danger">*</strong>)</label>
                                 </div>
                                 <div>
                                     <input name="amount" type="number" class="form-control">
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" id="btnHuy"><i
                             class="fa-solid fa-x"></i></button>
                     <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i></button>
                 </div>
             </form>
         </div>
     </div>
 </div>
 </div>
