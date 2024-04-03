<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <table id="block-list-partner" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example2_info">
          <tbody>
            @foreach($listPartner as $key => $partner)
            <tr role="row" id="partner-{{$partner->id}}" class="{{$key%2 == 0 ? 'even' : 'odd'}}">
              <td style="text-align: left !important;">{{$partner->name}}</td>
              <td class="text-center">
                <a href="javascript: void(0);" data-id="{{$partner->id}}" data-name="{{$partner->name}}" onclick="addItemToBlock(this, 1)" title="Thêm vào khối"><i class="fa fa-fw fa-plus"></i></a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->