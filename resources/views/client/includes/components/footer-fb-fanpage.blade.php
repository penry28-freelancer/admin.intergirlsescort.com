@if($facebook_fanpage_link = ListHelper::siteManagement('facebook_fanpage_link'))
<div class="footer-group-list">
    <h5 class="footer-group-list__header">Fanpage</h5>
    <p class="footer-group-list__desc">Tham gia cùng mình trên Facebook nhé!</p>
    <iframe src="https://www.facebook.com/plugins/page.php?href={{ $facebook_fanpage_link }}%2F&tabs&width=340&height=130&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=1149177302563131" width="340" height="130" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
</div>
@endif
