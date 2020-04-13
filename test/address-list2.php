<?php
require __DIR__. '/__connect_db.php';

$page_name = 'address-list2';

?>
<?php include __DIR__.'/tearaside/head.php'; ?>
<?php include __DIR__.'/tearaside/boostrap.php'; ?>
<style>
    tbody tr i.fa-trash-alt {
        color: red;
    }
</style>
<div class="container">
    <nav aria-label="Page navigation example">
    <ul class="pagination">
        <!-- <li class="page-item">
            <a class="page-link" href=""><i class="fas fa-arrow-circle-left"></i></a>
        </li>
        
        <li class="page-item">
            <a class="page-link" href=""></a>
        </li>
        <li class="page-item">
            <a class="page-link" href=""><i class="fas fa-arrow-circle-right"></i></a>
        </li> -->
    </ul>
    </nav>
    <table class="table table-striped">
        <thead>
        <tr>

            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Mobile</th>
            <th scope="col">Email</th>
            <th scope="col">Birthday</th>
            <th scope="col">Address</th>

        </tr>
        </thead>
        <tbody class="data-tbody">
        
        <!-- <tr>
            <td>
                <a class="del-link" href="">
                <i class="fas fa-trash-alt"></i>
                </a>
             </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
                <td></td>
                <td><a href=""><i class="fas fa-edit"></i></a></td>
            
        </tr> -->
        </tbody>
    </table>
</div>
<script>
    /*
    運作的流程 steps
    1. 取得資料 (包成 function
    2. 生頁碼列的按鈕
    3. 生資料表格
 */
const pagination = $('.pagination'),
    tbody = $('.data-tbody')

    const paginationTpl = obj=>{
    // {active:true, page:2}
    return `
        <li class="page-item ${obj.active ? 'active' : ''}">
            <a class="page-link" href="#${obj.page}">${obj.page}</a>
        </li>
    `;
};

const escapeTag = str=>{
  /*
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;'
   */
  return str
      .split('&').join('&amp;')
      .split('<').join('&lt;')
      .split('>').join('&gt;');
};

const itemTpl = obj => {
    return `
    <tr>
        <td>${obj.sid}</td>
        <td>${escapeTag(obj.name)}</td>
        <td>${escapeTag(obj.phone)}</td>
        <td>${escapeTag(obj.email)}</td>
        <td>${escapeTag(obj.birthday)}</td>
        <td>${escapeTag(obj.address)}</td>
    </tr>
    `;

};

function getDataByPage(page=1){
    $.get('address-list2-api.php', {page:page}, function(data){
        console.log(data);
        // 頁碼 ---
        let pStr = '';
        for(let i=1; i<=data.totalPages; i++){
            pStr += paginationTpl({
                active: page===i,
                page: i
            })
        }
        pagination.html(pStr);

        // 資料表格 ---
        let tStr = '';
        for(let i=0; i<data.rows.length; i++){
            let item = data.rows[i];
            tStr += itemTpl(item);
        }
        tbody.html(tStr);

    }, 'json');
}

function whenHashChange(){
    let hashStr = location.hash.slice(1);
    let page = parseInt(hashStr);

    if(page){
        getDataByPage(page);
    } else {
        getDataByPage(1);
    }
}

window.addEventListener('hashchange', whenHashChange);

whenHashChange();
</script>
<?php include __DIR__.'/tearaside/footer.php'; ?>
