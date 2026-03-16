(function ($) {
  $(document).ready(function () {
    $("product-list").DataTable();
    $("#basic-3").DataTable({
      order: [[3, "desc"]],
    });
    $("#basic-4").DataTable({
      columnDefs: [
        {
          targets: [0],
          orderData: [0, 1],
        },
        {
          targets: [1],
          orderData: [1, 0],
        },
        {
          targets: [4],
          orderData: [4, 0],
        },
      ],
    });
    $("#selling-product").DataTable({
      searchable: true,
      pageLength: 4,
    });
    $("#main-recent-order").DataTable({
      columnDefs: [
        {
          orderable: false,
          render: $.fn.dataTable.render.select(),
          targets: 0,
        },
      ],
      fixedColumns: {
        leftColumns: 2, // Note: 'start' is changed to 'leftColumns' in jQuery DataTables
      },
      order: [[1, "asc"]],
      scrollCollapse: true,
      select: {
        style: "multi",
        selector: "td:first-child",
      },
      responsive: {
        details: {
          type: "column",
          target: -1,
        },
        breakpoints: [
          { name: "fablet", pageLength: 4 },
          { name: "phone", pageLength: 6 },
        ],
      },
      searchable: true,
      responsive: true,
      pageLength: 4,
      lengthChange: false,
      autoWidth: false,
    });
    $("#recent-transaction").DataTable({
      columnDefs: [
        {
          orderable: false,
          render: $.fn.dataTable.render.select(),
          targets: 0,
        },
      ],
      fixedColumns: {
        leftColumns: 2, // Note: 'start' is changed to 'leftColumns' in jQuery DataTables
      },
      order: [[1, "asc"]],
      scrollCollapse: true,
      select: {
        style: "multi",
        selector: "td:first-child",
      },
      searchable: true,
      pageLength: 3,
      autoWidth: false,
      lengthMenu: [3, 5, 10, 15],
    });
    $("#top-customer").DataTable({
      columnDefs: [
        {
          orderable: false,
          render: $.fn.dataTable.render.select(),
          targets: 0,
        },
      ],
      fixedColumns: {
        leftColumns: 2, //
      },
      order: [[1, "asc"]],
      scrollCollapse: true,
      select: {
        style: "multi",
        selector: "td:first-child",
      },
      searchable: true,
      pageLength: 4,
      autoWidth: false,
      lengthChange: false,
      info: false,
    });
    $("#stock-report").DataTable({
      scrollCollapse: true,
      select: {
        style: "multi",
        selector: "td:first-child",
      },
      searchable: true,
      pageLength: 3,
      autoWidth: false,
      lengthChange: false,
      info: false,
    });
    $("#treading-t-product").DataTable({
      searching: false,
      pageLength: 4,
      autoWidth: false,
      lengthChange: false,
      info: false,
      responsive: {
        details: {
          type: "column",
          target: -1,
        },
      },
    });
    $("#selling-table").DataTable({
      searchable: true,
      pageLength: 4,
      autoWidth: false,
      responsive: true,
      lengthChange: false,
      info: false,
      columnDefs: [
        {
          orderable: false,
          render: $.fn.dataTable.render.select(),
          targets: 0,
        },
      ],
      fixedColumns: {
        leftColumns: 2,
      },
      order: [[1, "asc"]],
      scrollCollapse: true,
      select: {
        style: "multi",
        selector: "td:first-child",
      },
    });

    $("table.show-case").DataTable();
    $("#basic-5").DataTable({
      columnDefs: [
        {
          targets: [2],
          visible: false,
          searchable: false,
        },
        {
          targets: [3],
          visible: false,
        },
      ],
    });
    $("#basic-10").DataTable({
      pagingType: "full_numbers",
    });
    $("#basic-11").DataTable({
      scrollY: "200px",
      scrollCollapse: true,
      paging: false,
    });
    $("#basic-13").DataTable({
      scrollY: 200,
      scrollX: true,
    });
    $("#basic-14").DataTable({
      language: {
        decimal: ",",
        thousands: ".",
      },
    });

    // Dashboard-3
    $("#t-top-mentor").DataTable({
      columnDefs: [
        {
          orderable: false,
          render: $.fn.dataTable.render.select(),
          targets: 0,
        },
      ],
      fixedColumns: {
        leftColumns: 2, // Note: 'start' is changed to 'leftColumns' in jQuery DataTables
      },
      order: [[1, "asc"]],
      scrollCollapse: true,
      select: {
        style: "multi",
        selector: "td:first-child",
      },
      responsive: {
        details: {
          type: "column",
          target: -1,
        },
        breakpoints: [
          { name: "fablet", pageLength: 4 },
          { name: "phone", pageLength: 6 },
        ],
      },
      searchable: true,
      responsive: true,
      pageLength: 4,
      lengthChange: false,
      autoWidth: false,
    });
    $("#completed-course-table").DataTable({
      columnDefs: [
        {
          orderable: false,
          render: $.fn.dataTable.render.select(),
          targets: 0,
        },
      ],
      fixedColumns: {
        leftColumns: 2, // Note: 'start' is changed to 'leftColumns' in jQuery DataTables
      },
      order: [[1, "asc"]],
      scrollCollapse: true,
      select: {
        style: "multi",
        selector: "td:first-child",
      },
      searchable: true,
      responsive: true,
      pageLength: 4,
      lengthChange: false,
      autoWidth: false,
    });

    // Dashboard-4
    $("#currency-data-table").DataTable({
      searchable: true,
      pageLength: 4,
      lengthChange: false,
      autoWidth: false,
    });
    $("#average-sale").DataTable({
      searchable: true,
      pageLength: 4,
      lengthChange: false,
      autoWidth: false,
    });
    $("#performer-table").DataTable({
      searchable: true,
      pageLength: 4,
      lengthChange: false,
      autoWidth: false,
    });

    // Dashboard-5
    $("#campaigns-table").DataTable({
      searchable: true,
      pageLength: 5,
      autoWidth: false,
      lengthMenu: [5, 10, 15, 20],
    });

    // Dashboard-6
    $("#nft-creator").DataTable({
      searchable: true,
      pageLength: 4,
      lengthChange: false,
      autoWidth: false,
      info: false,
    });
    $("#nft-artwork").DataTable({
      searchable: true,
      pageLength: 4,
      lengthChange: false,
      autoWidth: false,
      info: false,
    });
    $("#nft-collection").DataTable({
      columnDefs: [
        {
          orderable: false,
          render: $.fn.dataTable.render.select(),
          targets: 0,
        },
      ],
      fixedColumns: {
        leftColumns: 2, // Note: 'start' is changed to 'leftColumns' in jQuery DataTables
      },
      order: [[1, "asc"]],
      scrollCollapse: true,
      select: {
        style: "multi",
        selector: "td:first-child",
      },
      searchable: true,
      responsive: true,
      pageLength: 3,
      autoWidth: false,
      lengthMenu: [3, 5, 10, 15],
      info: false,
    });

    // Dashboard-7
    $("#unpaid-fees").DataTable({
      columnDefs: [
        {
          orderable: false,
          render: $.fn.dataTable.render.select(),
          targets: 0,
        },
      ],
      fixedColumns: {
        leftColumns: 2, // Note: 'start' is changed to 'leftColumns' in jQuery DataTables
      },
      order: [[1, "asc"]],
      scrollCollapse: true,
      select: {
        style: "multi",
        selector: "td:first-child",
      },
      searchable: true,
      pageLength: 4,
      lengthChange: false,
      autoWidth: false,
    });
    $("#top-students").DataTable({
      columnDefs: [
        {
          orderable: false,
          render: $.fn.dataTable.render.select(),
          targets: 0,
        },
      ],
      fixedColumns: {
        leftColumns: 2, // Note: 'start' is changed to 'leftColumns' in jQuery DataTables
      },
      order: [[1, "asc"]],
      scrollCollapse: true,
      select: {
        style: "multi",
        selector: "td:first-child",
      },
      searchable: true,
      pageLength: 4,
      lengthChange: false,
      autoWidth: false,
    });
    $("#enroll-student").DataTable({
      searchable: true,
      pageLength: 4,
      lengthChange: false,
      autoWidth: false,
      info: false,
    });

    // Dashboard-9
    $("#finance-deal-table").DataTable({
      searchable: true,
      pageLength: 4,
      lengthChange: false,
      info: false,
      autoWidth: false,
    });
    $("#lead-table").DataTable({
      searchable: true,
      pageLength: 4,
      lengthChange: false,
      info: false,
      autoWidth: false,
    });

    // Dashboard-10
    $("#page-analytics-table").DataTable({
      columnDefs: [
        {
          orderable: false,
          render: $.fn.dataTable.render.select(),
          targets: 0,
        },
      ],
      fixedColumns: {
        leftColumns: 2, // Note: 'start' is changed to 'leftColumns' in jQuery DataTables
      },
      order: [[1, "asc"]],
      scrollCollapse: true,
      select: {
        style: "multi",
        selector: "td:first-child",
      },
      searchable: true,
      pageLength: 5,
      lengthMenu: [5, 10, 15, 20],
      autoWidth: false,
    });

    // Dashboard-11
    $("#employee-list").DataTable({
      columnDefs: [
        {
          orderable: false,
          render: $.fn.dataTable.render.select(),
          targets: 0,
        },
      ],
      fixedColumns: {
        leftColumns: 2,
      },
      order: [[1, "asc"]],
      scrollCollapse: true,
      select: {
        style: "multi",
        selector: "td:first-child",
      },
      searchable: true,
      pageLength: 4,
      responsive: true,
      lengthMenu: [4, 8, 12, 16],
      autoWidth: false,
    });

    $("#attendance-overview").DataTable({
      searchable: true,
      pageLength: 4,
      lengthMenu: [4, 8, 12, 16],
      autoWidth: false,
      lengthChange: false,
    });
    $("#leave-employee").DataTable({
      searchable: true,
      pageLength: 4,
      lengthMenu: [4, 8, 12, 16],
      autoWidth: false,
      lengthChange: false,
      info: false,
    });

    // Dashboard-12
    $("#all-project-table").DataTable({
      columnDefs: [
        {
          orderable: false,
          render: $.fn.dataTable.render.select(),
          targets: 0,
        },
      ],
      fixedColumns: {
        leftColumns: 2,
      },
      order: [[1, "asc"]],
      scrollCollapse: true,
      select: {
        style: "multi",
        selector: "td:first-child",
      },
      searchable: true,
      pageLength: 5,
      responsive: true,
      lengthMenu: [5, 10, 15, 20],
      autoWidth: false,
    });
    $("#team-performance-table").DataTable({
      fixedColumns: {
        leftColumns: 2,
      },
      order: [[1, "asc"]],
      scrollCollapse: true,
      select: {
        style: "multi",
        selector: "td:first-child",
      },
      searching: false,
      pageLength: 5,
      responsive: true,
      autoWidth: false,
      info: false,
      lengthChange: false,
    });

    $("#upcoming-datatable").DataTable({
      columnDefs: [
        {
          orderable: false,
          render: $.fn.dataTable.render.select(),
          targets: 0,
        },
      ],
      fixedColumns: {
        leftColumns: 2,
      },
      order: [[1, "asc"]],
      scrollCollapse: true,
      select: {
        style: "multi",
        selector: "td:first-child",
      },
      searching: false,
      pageLength: 5,
      responsive: true,
      autoWidth: false,
      info: false,
      lengthChange: false,
    });
    $("#recent-activity-table").DataTable({
      columnDefs: [
        {
          orderable: false,
          render: $.fn.dataTable.render.select(),
          targets: 0,
        },
      ],
      fixedColumns: {
        leftColumns: 2,
      },
      order: [[1, "asc"]],
      scrollCollapse: true,
      select: {
        style: "multi",
        selector: "td:first-child",
      },
      searchable: false,
      pageLength: 5,
      lengthMenu: [5, 10, 15, 20],
      responsive: true,
      autoWidth: false,
    });

    // Dashboard-13
    $("#shipment-tracking-table").DataTable({
      columnDefs: [
        {
          orderable: false,
          render: $.fn.dataTable.render.select(),
          targets: 0,
        },
      ],
      fixedColumns: {
        leftColumns: 2,
      },
      order: [[1, "asc"]],
      scrollCollapse: true,
      select: {
        style: "multi",
        selector: "td:first-child",
      },
      searchable: true,
      pageLength: 5,
      responsive: true,
      lengthMenu: [5, 10, 15, 20],
      autoWidth: false,
    });
    $("#vehicle-table").DataTable({
      columnDefs: [
        {
          orderable: false,
          render: $.fn.dataTable.render.select(),
          targets: 0,
        },
      ],
      fixedColumns: {
        leftColumns: 2,
      },
      order: [[1, "asc"]],
      scrollCollapse: true,
      select: {
        style: "multi",
        selector: "td:first-child",
      },
      searchable: true,
      pageLength: 5,
      responsive: true,
      lengthMenu: [5, 10, 15, 20],
      autoWidth: false,
    });

    // Scope-project
    $("#project-table").DataTable({
      pageLength: 4,
      autoWidth: false,
      lengthChange: false,
      info: false,
    });

    // Budget Table
    $("#budget-table").DataTable({
      pageLength: 4,
      autoWidth: false,
      lengthChange: false,
      info: false,
    });

    // Category table
    $("#project-status").DataTable({
      columnDefs: [
        {
          orderable: false,
          render: $.fn.dataTable.render.select(),
          targets: 0,
        },
      ],
      fixedColumns: {
        leftColumns: 2,
      },
      order: [[1, "asc"]],
      scrollCollapse: true,
      select: {
        style: "multi",
        selector: "td:first-child",
      },
      searchable: true,
      pageLength: 10,
      responsive: true,
      lengthMenu: [10, 14, 18, 22],
      autoWidth: false,
    });

    // API management
    $("#api-manage-table").DataTable({
      columnDefs: [
        {
          orderable: false,
          render: $.fn.dataTable.render.select(),
          targets: 0,
        },
      ],
      fixedColumns: {
        leftColumns: 2,
      },
      order: [[1, "asc"]],
      scrollCollapse: true,
      select: {
        style: "multi",
        selector: "td:first-child",
      },
      searchable: true,
      pageLength: 10,
      responsive: true,
      lengthMenu: [10, 15, 20, 25],
      autoWidth: false,
      layout: {
        topEnd: {
          search: {
            placeholder: "Search here...",
          },
        },
      },
    });

    // Manage review
    function format(d) {
      // d is the original data object for the row
      return `
      <table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">
        <tr>
          <td>Add Products</td>
          <td>${d.addProducts}</td>
        </tr>
        <tr>
          <td>Reviewer:</td>
          <td>${d.reviewer}</td>
        </tr>
        <tr>
          <td>Review:</td>
          <td>${d.review}</td>
        </tr>
        <tr>
          <td>Date:</td>
          <td>${d.date}</td>
        </tr>
        <tr>
          <td>Status:</td>
          <td>${d.status}</td>
        </tr>
        <tr class="product-removes inbox-data">
          <td>Action:</td>
          <td>${d.action}</td>
        </tr>
      </table>`;
    }

    let manageReview = $("#manage-review-table").DataTable({
      columnDefs: [
        {
          orderable: false,
          render: $.fn.dataTable.render.select(),
          targets: 0,
        },
        {
          orderable: false,
          className: "details-control",
          targets: 1, // Index of the details-control column
        },
      ],
      fixedColumns: {
        leftColumns: 2,
      },
      columns: [
        {
          className: "dt-select",
          orderable: false,
          data: null,
          defaultContent: "",
        },
        {
          className: "details-control",
          orderable: false,
          data: null,
          defaultContent: "",
        },
        {
          data: "addProducts",
        },
        {
          data: "reviewer",
        },
        {
          data: "review",
        },
        {
          data: "date",
        },
        {
          data: "status",
        },
        {
          data: "action",
        },
      ],
      order: [[2, "asc"]],
      scrollCollapse: true,
      select: {
        style: "multi",
        selector: "td:first-child",
      },
      searchable: true,
      pageLength: 10,
      responsive: false,
      autoWidth: false,
      layout: {
        topStart: {
          buttons: [
            {
              extend: "copy",
              className: "btn btn-outline-primary", // Ensure only btn-secondary is applied
            },
            {
              extend: "csv",
              className: "btn btn-outline-primary",
            },
            {
              extend: "excel",
              className: "btn btn-outline-primary",
            },
            {
              extend: "pdf",
              className: "btn btn-outline-primary",
            },
            {
              extend: "print",
              className: "btn btn-outline-primary",
            },
          ],
        },
        topEnd: {
          search: {
            placeholder: "Search here...",
          },
        },
      },
    });

    $("#manage-review-table tbody").on("click", "td.details-control", function () {
      var tr = $(this).closest("tr");
      var row = manageReview.row(tr);

      if (row.child.isShown()) {
        // This row is already open - close it
        row.child.hide();
        tr.removeClass("shown");
      } else {
        // Open this row
        row.child(format(row.data())).show();
        tr.addClass("shown");
      }
    });

    // Product report
    $("#product-report-table").DataTable({
      columnDefs: [
        {
          orderable: false,
          render: $.fn.dataTable.render.select(),
          targets: 0,
        },
      ],
      fixedColumns: {
        leftColumns: 2,
      },
      order: [[1, "asc"]],
      scrollCollapse: true,
      select: {
        style: "multi",
        selector: "td:first-child",
      },
      searchable: true,
      pageLength: 10,
      responsive: false,
      lengthMenu: [10, 15, 20, 25],
      details: false,
      autoWidth: false,
      layout: {
        topStart: {
          buttons: [
            {
              extend: "copy",
              className: "btn btn-outline-primary", // Ensure only btn-secondary is applied
            },
            {
              extend: "csv",
              className: "btn btn-outline-primary",
            },
            {
              extend: "excel",
              className: "btn btn-outline-primary",
            },
            {
              extend: "pdf",
              className: "btn btn-outline-primary",
            },
            {
              extend: "print",
              className: "btn btn-outline-primary",
            },
          ],
        },
        topEnd: {
          search: {
            placeholder: "Search here...",
          },
        },
      },
    });

    // Sales report
    $("#sale-report-table").DataTable({
      columnDefs: [
        {
          orderable: false,
          render: $.fn.dataTable.render.select(),
          targets: 0,
        },
      ],
      fixedColumns: {
        leftColumns: 2,
      },
      order: [[1, "asc"]],
      scrollCollapse: true,
      select: {
        style: "multi",
        selector: "td:first-child",
      },
      searchable: true,
      pageLength: 12,
      responsive: false,
      autoWidth: false,
      layout: {
        topStart: {
          buttons: [
            {
              extend: "copy",
              className: "btn btn-outline-primary", // Ensure only btn-secondary is applied
            },
            {
              extend: "csv",
              className: "btn btn-outline-primary",
            },
            {
              extend: "excel",
              className: "btn btn-outline-primary",
            },
            {
              extend: "pdf",
              className: "btn btn-outline-primary",
            },
            {
              extend: "print",
              className: "btn btn-outline-primary",
            },
          ],
        },
        topEnd: {
          search: {
            placeholder: "Search here...",
          },
        },
      },
    });

    // Sales return report
    $("#sale-return-report-table").DataTable({
      columnDefs: [
        {
          orderable: false,
          render: $.fn.dataTable.render.select(),
          targets: 0,
        },
      ],
      fixedColumns: {
        leftColumns: 2,
      },
      order: [[1, "asc"]],
      scrollCollapse: true,
      select: {
        style: "multi",
        selector: "td:first-child",
      },
      searchable: true,
      pageLength: 12,
      responsive: false,
      autoWidth: false,
      layout: {
        topStart: {
          buttons: [
            {
              extend: "copy",
              className: "btn btn-outline-primary", // Ensure only btn-secondary is applied
            },
            {
              extend: "csv",
              className: "btn btn-outline-primary",
            },
            {
              extend: "excel",
              className: "btn btn-outline-primary",
            },
            {
              extend: "pdf",
              className: "btn btn-outline-primary",
            },
            {
              extend: "print",
              className: "btn btn-outline-primary",
            },
          ],
        },
        topEnd: {
          search: {
            placeholder: "Search here...",
          },
        },
      },
    });

    // Customer order report table
    $("#customer-order-table").DataTable({
      columnDefs: [
        {
          orderable: false,
          render: $.fn.dataTable.render.select(),
          targets: 0,
        },
      ],
      fixedColumns: {
        leftColumns: 2,
      },
      order: [[1, "asc"]],
      scrollCollapse: true,
      select: {
        style: "multi",
        selector: "td:first-child",
      },
      searchable: true,
      pageLength: 10,
      responsive: false,
      autoWidth: false,
      layout: {
        topStart: {
          buttons: [
            {
              extend: "copy",
              className: "btn btn-outline-primary", // Ensure only btn-secondary is applied
            },
            {
              extend: "csv",
              className: "btn btn-outline-primary",
            },
            {
              extend: "excel",
              className: "btn btn-outline-primary",
            },
            {
              extend: "pdf",
              className: "btn btn-outline-primary",
            },
            {
              extend: "print",
              className: "btn btn-outline-primary",
            },
          ],
        },
        topEnd: {
          search: {
            placeholder: "Search here...",
          },
        },
      },
    });

    // Product list view table
    $("#product-list-view").DataTable({
      columnDefs: [
        {
          orderable: false,
          render: $.fn.dataTable.render.select(),
          targets: 0,
        },
      ],
      fixedColumns: {
        leftColumns: 2,
      },
      order: [[1, "asc"]],
      scrollCollapse: true,
      select: {
        style: "multi",
        selector: "td:first-child",
      },
      searchable: true,
      pageLength: 14,
      responsive: true,
      lengthMenu: [14, 18, 22, 26],
      autoWidth: false,
    });

    // Vendor details
    $("#seller-product-details").DataTable({
      columnDefs: [
        {
          orderable: false,
          render: $.fn.dataTable.render.select(),
          targets: 0,
        },
      ],
      fixedColumns: {
        leftColumns: 2,
      },
      order: [[1, "asc"]],
      scrollCollapse: true,
      select: {
        style: "multi",
        selector: "td:first-child",
      },
      searchable: true,
      pageLength: 6,
      responsive: true,
      lengthMenu: [6, 10, 15, 20],
      autoWidth: false,
    });

    // Vendor selling product
    $("#vendor-selling-product").DataTable({
      columnDefs: [
        {
          orderable: false,
          render: $.fn.dataTable.render.select(),
          targets: 0,
        },
      ],
      fixedColumns: {
        leftColumns: 2,
      },
      order: [[1, "asc"]],
      scrollCollapse: true,
      select: {
        style: "multi",
        selector: "td:first-child",
      },
      searchable: true,
      pageLength: 6,
      responsive: true,
      lengthMenu: [6, 10, 15, 20],
      autoWidth: false,
    });

    // Vendor recent order
    $("#seller-recent-order").DataTable({
      columnDefs: [
        {
          orderable: false,
          render: $.fn.dataTable.render.select(),
          targets: 0,
        },
      ],
      fixedColumns: {
        leftColumns: 2,
      },
      order: [[1, "asc"]],
      scrollCollapse: true,
      select: {
        style: "multi",
        selector: "td:first-child",
      },
      searchable: true,
      pageLength: 6,
      responsive: true,
      lengthMenu: [6, 10, 15, 20],
      autoWidth: false,
    });

    // Cart Table
    $("#cart-table").DataTable({
      columnDefs: [
        {
          orderable: false,
          render: $.fn.dataTable.render.select(),
          targets: 0,
        },
      ],
      fixedColumns: {
        leftColumns: 2,
      },
      order: [[1, "asc"]],
      scrollCollapse: true,
      select: {
        style: "multi",
        selector: "td:first-child",
      },
      lengthChange: false,
      searching: false,
      responsive: true,
      info: false,
      paging: false,
      autoWidth: false,
    });

    // Order history
    $("#order-history-table").DataTable({
      columnDefs: [
        {
          orderable: false,
          render: $.fn.dataTable.render.select(),
          targets: 0,
        },
      ],
      fixedColumns: {
        leftColumns: 2,
      },
      order: [[1, "asc"]],
      scrollCollapse: true,
      select: {
        style: "multi",
        selector: "td:first-child",
      },
      searchable: true,
      pageLength: 10,
      responsive: true,
      lengthMenu: [10, 15, 20, 25],
      autoWidth: false,
    });

    // Subscribed user
    $("#subscribed-user-wrapper").DataTable({
      columnDefs: [
        {
          orderable: false,
          render: $.fn.dataTable.render.select(),
          targets: 0,
        },
      ],
      fixedColumns: {
        leftColumns: 2,
      },
      order: [[1, "asc"]],
      scrollCollapse: true,
      select: {
        style: "multi",
        selector: "td:first-child",
      },
      searchable: true,
      pageLength: 10,
      responsive: false,
      lengthMenu: [10, 15, 20, 25],
      autoWidth: false,
      details: false,
      layout: {
        topStart: {
          buttons: [
            {
              extend: "copy",
              className: "btn btn-outline-primary", // Ensure only btn-secondary is applied
            },
            {
              extend: "csv",
              className: "btn btn-outline-primary",
            },
            {
              extend: "excel",
              className: "btn btn-outline-primary",
            },
            {
              extend: "pdf",
              className: "btn btn-outline-primary",
            },
            {
              extend: "print",
              className: "btn btn-outline-primary",
            },
          ],
        },
        topEnd: {
          search: {
            placeholder: "Search here...",
          },
        },
      },
    });

    // Roles ans permission
    $("#roles-permission").DataTable({
      columnDefs: [
        {
          orderable: false,
          render: $.fn.dataTable.render.select(),
          targets: 0,
        },
      ],
      fixedColumns: {
        leftColumns: 2,
      },
      order: [[1, "asc"]],
      scrollCollapse: true,
      select: {
        style: "multi",
        selector: "td:first-child",
      },
      searchable: true,
      pageLength: 10,
      responsive: true,
      lengthMenu: [10, 14, 18, 22],
      autoWidth: false,
      layout: {
        topEnd: {
          search: {
            placeholder: "Search here...",
          },
        },
      },
    });

    // Tasks
    $("#main-task-table").DataTable({
      columnDefs: [
        {
          orderable: false,
          render: $.fn.dataTable.render.select(),
          targets: 0,
        },
      ],
      fixedColumns: {
        leftColumns: 2,
      },
      order: [[1, "asc"]],
      scrollCollapse: true,
      select: {
        style: "multi",
        selector: "td:first-child",
      },
      searchable: true,
      pageLength: 10,
      responsive: true,
      lengthMenu: [10, 15, 20, 25],
      autoWidth: false,
    });

    // Candidates
    $("#candidates-table").DataTable({
      columnDefs: [
        {
          orderable: false,
          render: $.fn.dataTable.render.select(),
          targets: 0,
        },
      ],
      fixedColumns: {
        leftColumns: 2, // Note: 'start' is changed to 'leftColumns' in jQuery DataTables
      },
      order: [[1, "asc"]],
      scrollCollapse: true,
      select: {
        style: "multi",
        selector: "td:first-child",
      },
      searchable: true,
      pageLength: 10,
      responsive: true,
      lengthMenu: [10, 15, 20, 25],
      autoWidth: false,
      layout: {
        topEnd: {
          search: {
            placeholder: "Search here...",
          },
        },
      },
    });

    // Advance data
    var table = $("#advance-1").DataTable();
    $("#advance-1 tbody").on("click", "tr", function () {
      var data = table.row(this).data();
      alert("You clicked on " + data[0] + "'s row");
    });
    var eventFired = function (type) {
      var n = $("#demo_info")[0];
      n.innerHTML += '<div class="me-2"><b>' + type + " event - </b>" + new Date().getTime() + "</div>";
      n.scrollTop = n.scrollHeight;
    };
    $("#advance-2")
      .on("order.dt", function () {
        eventFired("Order");
      })
      .on("search.dt", function () {
        eventFired("Search");
      })
      .on("page.dt", function () {
        eventFired("Page");
      })
      .DataTable();
    $("#advance-3").DataTable({
      columnDefs: [
        {
          render: function (data, type, row) {
            return data + " (" + row[3] + ")";
          },
          targets: 0,
        },
        { visible: false, targets: [3] },
      ],
    });
    $("#advance-4").DataTable({
      lengthMenu: [
        [10, 25, 50, -1],
        [10, 25, 50, "All"],
      ],
    });
    $("#advance-5").DataTable({
      dom: '<"top"iflp<"clear">>rt<"bottom"iflp<"clear">>',
    });
    $("#advance-6").DataTable({
      columnDefs: [
        {
          visible: false,
          targets: -1,
        },
      ],
    });
    $("#advance-7").DataTable({
      columns: [{ data: "name" }, { data: "position" }, { data: "office" }, { data: "age" }, { data: "start_date" }, { data: "salary" }],
    });
    $("#advance-8").DataTable({
      language: {
        url: "../assets/json/German.json",
      },
    });
    $("#advance-9").DataTable({
      searching: false,
      ordering: false,
    });
    $("#advance-10").DataTable({
      createdRow: function (row, data, index) {
        if (data[5].replace(/[\$,]/g, "") * 1 > 150000) {
          $("td", row).eq(5).addClass("text-danger");
        }
      },
    });
    var table = $("#advance-11").DataTable({
      columnDefs: [{ visible: false, targets: 2 }],
      order: [[2, "asc"]],
      displayLength: 25,
      drawCallback: function (settings) {
        var api = this.api();
        var rows = api.rows({ page: "current" }).nodes();
        var last = null;
        api
          .column(2, { page: "current" })
          .data()
          .each(function (group, i) {
            if (last !== group) {
              $(rows)
                .eq(i)
                .before('<tr class="group"><td colspan="5">' + group + "</td></tr>");
              last = group;
            }
          });
      },
    });
    $("#advance-11 tbody").on("click", "tr.group", function () {
      var currentOrder = table.order()[0];
      if (currentOrder[0] === 2 && currentOrder[1] === "asc") {
        table.order([2, "desc"]).draw();
      } else {
        table.order([2, "asc"]).draw();
      }
    });
    $("#advance-12").DataTable({
      footerCallback: function (row, data, start, end, display) {
        var api = this.api(),
          data;
        var intVal = function (i) {
          return typeof i === "string" ? i.replace(/[\$,]/g, "") * 1 : typeof i === "number" ? i : 0;
        };
        total = api
          .column(4)
          .data()
          .reduce(function (a, b) {
            return intVal(a) + intVal(b);
          }, 0);
        pageTotal = api
          .column(4, { page: "current" })
          .data()
          .reduce(function (a, b) {
            return intVal(a) + intVal(b);
          }, 0);
        $(api.column(4).footer()).html("$" + pageTotal + " ( $" + total + " total)");
      },
    });
    $("#advance-13").DataTable({
      dom: '<"toolbar">frtip',
    });
    $("div.toolbar").html("<b>Hello This is custom toolbar</b>");
    $("#advance-14").DataTable({
      aoColumns: [null, null, { orderSequence: ["asc"] }, { orderSequence: ["desc", "asc", "asc"] }, { orderSequence: ["desc"] }, null],
    });
    $("#example-style-1").DataTable();
    $("#example-style-2").DataTable();
    $("#example-style-3").DataTable();
    $("#example-style-4").DataTable();
    $("#example-style-5").DataTable();
    $("#example-style-6").DataTable();
    $("#example-style-7").DataTable();
    $("#example-style-8").DataTable();

    //row select multiple data table start here
    var srow = $("#row-select-multiple").DataTable();
    $("#row-select-multiple tbody").on("click", "tr", function () {
      $(this).toggleClass("selected");
    });
    $("#multiple-row-select-btn").on("click", function () {
      alert(srow.rows(".selected").data().length + " row(s) selected");
    });
    //row select multiple data table end here

    //form input submit start here
    var table = $("#form-input-datatable").DataTable();
    $("#form-input-datatable-submit").on("click", function () {
      var data = table.$("input, select").serialize();
      alert("The following data would have been submitted to the server: \n\n" + data.substr(0, 120) + "...");
      return false;
    });
    //form input submit end here
    //show hide column start here
    var sh = $("#show-hide-datatable").DataTable({
      scrollY: "200px",
      paging: false,
    });
    //show hide column end here
    //seach API regular expression start
    function filterGlobal() {
      $("#search-api-datatable").DataTable().search($("#g-filter").val(), $("#global_regex").prop("checked"), $("#global_smart").prop("checked")).draw();
    }
    function filterColumn(i) {
      $("#search-api-datatable")
        .DataTable()
        .column(i)
        .search($("#col" + i + "_filter").val(), $("#col" + i + "_regex").prop("checked"), $("#col" + i + "_smart").prop("checked"))
        .draw();
    }
    $("#search-api-datatable").DataTable();
    $("input.g-filter").on("keyup click", function () {
      filterGlobal();
    });
    $("input.column_filter").on("keyup click", function () {
      filterColumn($(this).parents("tr").attr("data-column"));
    });
    //seach API regular expression start
    //Ajax Data Source (Arrays) start
    $("#ajax-data-array").DataTable({
      ajax: "../assets/ajax/arrays.txt",
    });
    //Ajax Data Source (Arrays) start
    //Ajax Data Source (object) start
    $("#ajax-data-object").DataTable({
      ajax: "../assets/ajax/object.txt",
      columns: [
        {
          data: "name",
        },
        {
          data: "position",
        },
        {
          data: "office",
        },
        {
          data: "extn",
        },
        {
          data: "start_date",
        },
        {
          data: "salary",
        },
      ],
    });
    //Ajax Data Source (object) end
    //Ajax nested object data start
    $("#ajax-data-nested-object").DataTable({
      processing: true,
      ajax: "../assets/ajax/object_nested.txt",
      columns: [
        {
          data: "name",
        },
        {
          data: "hr.position",
        },
        {
          data: "contact.0",
        },
        {
          data: "contact.1",
        },
        {
          data: "hr.start_date",
        },
        {
          data: "hr.salary",
        },
      ],
    });
    //Ajax nested object data start
    //Ajax orthogonal data start here
    $("#orthogonal-data").DataTable({
      ajax: "../assets/ajax/orthogonal.txt",
      columns: [
        {
          data: "name",
        },
        {
          data: "position",
        },
        {
          data: "office",
        },
        {
          data: "extn",
        },
        {
          data: {
            _: "start_date.display",
            sort: "start_date.timestamp",
          },
        },
        {
          data: "salary",
        },
      ],
    });
    //Ajax orthogonal data end here
    // Ajax Generated content for a column start
    var generatetable = $("#auto-generate-content").DataTable({
      ajax: "../assets/ajax/arrays.txt",
      columnDefs: [
        {
          targets: -1,
          data: null,
          defaultContent: "<button>Click!</button>",
        },
      ],
    });
    $("#auto-generate-content tbody").on("click", "button", function () {
      var data = generatetable.row($(this).parents("tr")).data();
      alert(data[0] + "'s salary is: " + data[5]);
    });
    // Ajax Generated content for a column end
    //Ajax render start here
    $("#render-datatable").DataTable({
      ajax: "../assets/ajax/arrays.txt",
      deferRender: true,
    });
    //Ajax render end here
    // Server Side proccessing start
    $("#server-side-datatable").DataTable({
      processing: true,
      serverSide: true,
      ajax: "../assets/ajax/server-processing.php",
    });
    //http server side datatable start
    $("#datatable-http").DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: "../assets/ajax/server-processing.php",
        data: function (d) {
          d.myKey = "myValue";
        },
      },
      columns: [
        {
          data: "first_name",
        },
        {
          data: "last_name",
        },
        {
          data: "position",
        },
        {
          data: "office",
        },
        {
          data: "start_date",
        },
        {
          data: "salary",
        },
      ],
    });
    //http server side datatable end
    //datatable post start here
    $("#datatable-post").DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: "../assets/ajax/post.php",
        type: "post",
      },
      columns: [
        {
          data: "first_name",
        },
        {
          data: "last_name",
        },
        {
          data: "position",
        },
        {
          data: "office",
        },
        {
          data: "start_date",
        },
        {
          data: "salary",
        },
      ],
    });
    //datatable post start here
    var table = $("#dt-plugin-method").DataTable();
    $('<button class="btn btn-primary  m-b-20">sum of age in all rows</button>')
      .prependTo(".dt-plugin-buttons")
      .on("click", function () {
        alert("Column sum is: " + table.column(3).data().sum());
      });
    $('<button class="btn btn-primary m-r-10 m-b-20">sum of  age of visible rows</button>')
      .prependTo(".dt-plugin-buttons")
      .on("click", function () {
        alert(
          "Column sum is: " +
            table
              .column(3, {
                page: "current",
              })
              .data()
              .sum()
        );
      });
    //Api datatable end here
    //Ordering Plug-ins (with type detection) start here
    $.fn.dataTable.ext.type.detect.unshift(function (d) {
      return d === "Low" || d === "Medium" || d === "High" ? "salary-grade" : null;
    });
    $.fn.dataTable.ext.type.order["salary-grade-pre"] = function (d) {
      switch (d) {
        case "Low":
          return 1;
        case "Medium":
          return 2;
        case "High":
          return 3;
      }
      return 0;
    };
    $("#datatable-ordering").DataTable();
    //Ordering Plug-ins (with type detection) end here

    //datatable dom ordering start here
    $.fn.dataTable.ext.order["dom-text"] = function (settings, col) {
      return this.api()
        .column(col, {
          order: "index",
        })
        .nodes()
        .map(function (td, i) {
          return $("input", td).val();
        });
    };
    $.fn.dataTable.ext.order["dom-text-numeric"] = function (settings, col) {
      return this.api()
        .column(col, {
          order: "index",
        })
        .nodes()
        .map(function (td, i) {
          return $("input", td).val() * 1;
        });
    };
    $.fn.dataTable.ext.order["dom-select"] = function (settings, col) {
      return this.api()
        .column(col, {
          order: "index",
        })
        .nodes()
        .map(function (td, i) {
          return $("select", td).val();
        });
    };
    $.fn.dataTable.ext.order["dom-checkbox"] = function (settings, col) {
      return this.api()
        .column(col, {
          order: "index",
        })
        .nodes()
        .map(function (td, i) {
          return $("input", td).prop("checked") ? "1" : "0";
        });
    };
    $(document).ready(function () {
      $("#datatable-livedom").DataTable({
        columns: [
          null,
          {
            orderDataType: "dom-text-numeric",
          },
          {
            orderDataType: "dom-text",
            type: "string",
          },
          {
            orderDataType: "dom-select",
          },
        ],
      });
    });
    //datatable dom ordering end here
    // Remove `btn-secondary` class dynamically
    $(".dt-buttons .btn").removeClass("btn-secondary");
  });
})(jQuery);
