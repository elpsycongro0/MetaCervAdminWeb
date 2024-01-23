<script type="text/javascript">
    $(document).ready(function() {
        $('#eventos_tabla').DataTable({
            "dom": 'l<"pull-left"f><"pull-right"B>rt<"pull-left"i><"pull-right"p>',
            "buttons": [  'csv', 'excel', 'print'],
            "language":{"url":"//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"},
            "processing": true,
            "ajax": {
                url: '{{route('users.getdata')}}',
                type: 'GET',
            },

            "columns":[
                { "data": "name","searchable":true },
                
            ],
            search : {
                "regex" : true
            },
        });
        
    });
</script>