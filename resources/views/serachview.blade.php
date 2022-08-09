<x-app-layout>


    <div class="container">
        <div class="flex flex-wrap border ">
            <div class="">
                    <form action="">
                        <table>
                            <thead>
                                <tr class="abc">
                                    <td class="row">
                                        <input type="text">
                                        <x-Quotation.inputs.text   id="grandtotal" name="grandtotal" label="" value="" required/>
                                    </td>
                                </tr>
                            </thead>
                        </table>
                        <span id="add">add</span>
                    </form>
            </div>
        </div>
    </div>
    @section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" integrity="sha512-aOG0c6nPNzGk+5zjwyJaoRUgCdOrfSDhmMID2u4+OIslr0GjpLKo7Xm0Ao3xmpM4T8AmIouRkqwj1nrdVsLKEQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @endsection

    <script>
        $(document).ready(function(){
            $('#add').click(function(e){
                e.preventDefault();
                console.log('in');
                $('thead').append('<input type="text">')
            });
        });
    </script>




</x-app-layout>

