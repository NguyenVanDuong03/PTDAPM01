@include('header')

<div class="container" style="margin-top: 120px;">
    <h2 style="width: 450px; margin-left: 35%;" class="text-center text-primary fw-bold fs-1 border-top border-bottom border-4">LIST OF PRODUCTS</h2>

    <table class=" table table-hover table-success">

        <a href="{{route('products.create')}}">
            <button class="btn btn-success btn-zoom-out mb-3"><i class="fas fa-plus me-2"></i>Add new product</button>
        </a>
        <thead>
            <tr class="fs-4 bg table-danger">
                <th scope="col" class="text-center">STT</th>
                <th scope="col">Product Name</th>
                <th scope="col">Brand</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Category Name</th>
                <th class="text-center" scope="col" colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- {{$stt = 1}} -->
            @foreach($products as $item)
            <tr>
                <th class="text-center fs-4" scope="row">{{$stt}}</th>
                <td>{{$item->name}}</td>
                <td>{{$item->brand}}</td>
                <td>{{$item->price}}</td>
                <td>{{$item->quantity}}</td>
                <td>{{$item->getCategoryName()}}</td>



                <td class="text-center"><a class="btn text-white btn-info btn-eye-zoom" href="{{route('products.show',['product'=>$item->id])}}"><i class="fas fa-eye"></i></a></td>
                <td class="text-center"><a class="btn text-white btn-warning btn-pen-zoom" href="{{route('products.edit',['product'=>$item->id])}}"><i class="fas fa-pen-clip"></i></a></td>
                <td class="text-center"><button class="btn btn-trash-zoom btn-danger" data-bs-toggle='modal' data-bs-target='#A{{$item->id}}'><i class="fa-regular fa-trash-can"></i></button></td>
                <!-- {{$stt++}} -->
                <!-- Modal HIển thị thông bao xóa  -->
                <div class='modal fade' id='A{{$item->id}}' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                    <div class='modal-dialog'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <h1 clas s='modal-title fs-5' id='exampleModalLabel'>Confirm</h1>
                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                            </div>
                            <div class='modal-body'>
                                Do you want to delete this product: {{$item->name}}
                            </div>
                            <div class='modal-footer'>
                                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancel</button>
                                <form action="{{route('products.destroy',['product'=>$item->id])}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class='btn btn-primary'>Delete</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- paginating  -->

<div class="d-flex justify-content-center align-items-center my-2">
    <a class="btn btn-success" href="{{route('products.index', ['pageIndex' => $pageIndex - 1])}}">Back</a>
    @for($i = 1; $i <= $numberOfPage; $i++) @if($pageIndex==$i) <a class="btn btn-primary ms-2" href="{{route('products.index', ['pageIndex' => $i])}}">{{$i}}</a>
        @else
        <a class="btn btn-success ms-2" href="{{route('products.index', ['pageIndex' => $i])}}">{{$i}}</a>
        @endif
        @endfor
        <a class="btn btn-success ms-2" href="{{route('products.index', ['pageIndex' => $pageIndex + 1])}}">Next</a>
</div>

<!-- modal inform -->


<div id="myDialog" style="display: none;" class="px-5 py-3 rounded-3">
    <h4 class="text-primary fw-bold fs-4">Annouce</h4>
    <p class="text-success">{{ session('mes') }}</p>
    <button id="confirmButton" class="float-end rounded-2">Ok</button>
</div>
<style>
    #myDialog {
        position: fixed;
        width: 500px;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: #ffffff;
        padding: 20px;
        border: 1px solid #ccc;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    #confirmButton {
        padding: 10px 20px;
        background: #007bff;
        color: #ffffff;
        border: none;
        cursor: pointer;
    }
</style>
@if(session('mes'))
<script>
    var dialog = document.getElementById("myDialog");
    var confirmButton = document.getElementById("confirmButton");

    dialog.style.display = "block";
    confirmButton.addEventListener("click", function() {
        dialog.style.display = "none";
    });
    // alert("{{ session('Success') }}")
</script>
@endif

@include('footer')