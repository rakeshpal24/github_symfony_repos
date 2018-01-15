$(document).ready(function($){
//    $('#tblSymfonyRepos').DataTable({
//        processing: true,
//        serverSide: true,
//        paging: true,
//        columnDefs: [
//            { targets: 0, searchable: false, orderable: false, data: "name", defaultContent: "N/A", render: function ( data, type, row, meta ) {
//      return '<a href="'+data+'">Download</a>';
//    } },
//            { data: "owner.url" },
//            { data: "description" },
//            { data: "created_at" },
//            { data: "updated_at" },
//            { data: "homepage" },
//            { data: "size" },
//            { data: "forks_count" },
//            { data: "stargazers_count" },
//            { data: "open_issues_count" },
//            { data: "license" }
//
//        ],
//        ajax: {
//            url: "http://localhost/symfony-the-great/public/git/repos",
//            type: "POST"
//        }
//    });

    $('#tblSymfonyRepos').DataTable({
        pagingType: "full_numbers"
    });
});