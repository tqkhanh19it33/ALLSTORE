<?php

namespace App\Http\Controllers\trangchu;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Requests\Product\sanphamRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Services\Sanpham\sanphamService;
use Illuminate\Support\Facades\Auth;

class sanphamController extends Controller
{
    protected $sanphamService;
    public function __construct(sanphamService $sanphamservice)
    {
        $this->sanphamService = $sanphamservice;
    }

    public function giam_gia(){
        return view('web.sanpham.SPgiamgia', [
            'title' => 'Sản phẩm giảm giá',
            'giamgias' => $this->sanphamService->getSPGG(),
        ]);
    }

    public function sanphamthuvien()
    {
//        echo '1234';
        return view('web.sanpham.sanpham_hienthiThuVien', [
            'title' => 'Sản Phẩm',
            'ten' => 'SẢN PHẨM',
            'action' => 'ko',
            'duoidan' => 'thuvien',
            'products' => $this->sanphamService->getAll(),
            'phongcachs' => $this->sanphamService->getphongcach(),
            'nhanhieus' => $this->sanphamService->getnhanhieu(),
            'sizes' => $this->sanphamService->getsize(),

        ]);
    }
    public function BL_sanphamthuvien(sanphamRequest $request)
    {
//        dd($request->input());

//        echo '1234';
        return view('web.sanpham.sanpham_hienthiThuVien', [
            'title' => 'Sản Phẩm',
            'ten' => 'SẢN PHẨM',
            'action' => 'ko',
            'duoidan' => 'thuvien',
            'products' => $this->sanphamService->getBLoc($request),
            'phongcachs' => $this->sanphamService->getphongcach(),
            'nhanhieus' => $this->sanphamService->getnhanhieu(),
            'sizes' => $this->sanphamService->getsize(),

        ]);
    }
    public function sanphamthuvien_nam(){
        return view('web.sanpham.sanpham_hienthiThuVien', [
            'title' => 'Sản Phẩm',
            'ten' => 'SẢN PHẨM',
            'action' => 'ko',
            'ten1' => 'Nam',
            'tenduoi' => 'Nam',
            'duoidan' => 'thuvien',
            'products' => $this->sanphamService->getnam(),
            'phongcachs' => $this->sanphamService->getphongcach(),
            'nhanhieus' => $this->sanphamService->getnhanhieu(),
            'sizes' => $this->sanphamService->getsize(),

        ]);
    }
    public function BL_sanphamthuvien_nam(sanphamRequest $request)
    {
//        dd($request->input());
//        echo '1234';
        return view('web.sanpham.sanpham_hienthiThuVien', [
            'title' => 'Sản Phẩm',
            'ten' => 'SẢN PHẨM',
            'action' => 'ko',
            'ten1' => 'Nam',
            'tenduoi' => 'Nam',
            'duoidan' => 'thuvien',
            'products' => $this->sanphamService->getBLoc_nam($request),
            'phongcachs' => $this->sanphamService->getphongcach(),
            'nhanhieus' => $this->sanphamService->getnhanhieu(),
            'sizes' => $this->sanphamService->getsize(),

        ]);
    }
    public function sanphamthuvien_nu(){
        return view('web.sanpham.sanpham_hienthiThuVien', [
            'title' => 'Sản Phẩm',
            'ten' => 'SẢN PHẨM',
            'action' => 'ko',
            'ten1' => 'Nu',
            'tenduoi' => 'Nu',
            'duoidan' => 'thuvien',
            'products' => $this->sanphamService->getnu(),
            'phongcachs' => $this->sanphamService->getphongcach(),
            'nhanhieus' => $this->sanphamService->getnhanhieu(),
            'sizes' => $this->sanphamService->getsize(),

        ]);
    }
    public function BL_sanphamthuvien_nu(sanphamRequest $request)
    {
//        dd($request->input());
//        echo '1234';
        return view('web.sanpham.sanpham_hienthiThuVien', [
            'title' => 'Sản Phẩm',
            'ten' => 'SẢN PHẨM',
            'action' => 'ko',
            'ten1' => 'Nu',
            'tenduoi' => 'Nu',
            'duoidan' => 'thuvien',
            'products' => $this->sanphamService->getBLoc_nu($request),
            'phongcachs' => $this->sanphamService->getphongcach(),
            'nhanhieus' => $this->sanphamService->getnhanhieu(),
            'sizes' => $this->sanphamService->getsize(),

        ]);
    }
    public function sanphamthuvien_treem(){

//        dd($request->input());
//        echo '1234';
        return view('web.sanpham.sanpham_hienthiThuVien', [
            'title' => 'Sản Phẩm',
            'ten' => 'SẢN PHẨM',
            'action' => 'ko',
            'ten1' => 'Tre_em',
            'tenduoi' => 'Tre_em',
            'duoidan' => 'thuvien',
            'products' => $this->sanphamService->gettreeem(),
            'phongcachs' => $this->sanphamService->getphongcach(),
            'nhanhieus' => $this->sanphamService->getnhanhieu(),
            'sizes' => $this->sanphamService->getsize(),

        ]);
    }
    public function BL_sanphamthuvien_treem(sanphamRequest $request)
    {
//        dd($request->input());
//        echo '1234';
        return view('web.sanpham.sanpham_hienthiThuVien', [
            'title' => 'Sản Phẩm',
            'ten' => 'SẢN PHẨM',
            'action' => 'ko',
            'ten1' => 'Tre_em',
            'tenduoi' => 'Tre_em',
            'duoidan' => 'thuvien',
            'products' => $this->sanphamService->getBLoc_treem($request),
            'phongcachs' => $this->sanphamService->getphongcach(),
            'nhanhieus' => $this->sanphamService->getnhanhieu(),
            'sizes' => $this->sanphamService->getsize(),

        ]);
    }
    public function sanphamthuvien_1_3_nu(){
        return view('web.sanpham.sanpham_hienthiThuVien', [
            'title' => 'Sản Phẩm',
            'ten' => 'SẢN PHẨM',
            'action' => 'ko',
            'ten1' => 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nữ',
            'tenduoi' => '1_3_nu',
            'duoidan' => 'thuvien',
            'products' => $this->sanphamService->get_1_3_nu(),
            'phongcachs' => $this->sanphamService->getphongcach(),
            'nhanhieus' => $this->sanphamService->getnhanhieu(),
            'sizes' => $this->sanphamService->getsize(),

        ]);
    }
    public function BL_sanphamthuvien_1_3_nu(sanphamRequest $request){
        return view('web.sanpham.sanpham_hienthiThuVien', [
            'title' => 'Sản Phẩm',
            'ten' => 'SẢN PHẨM',
            'action' => 'ko',
            'ten1' => 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nữ',
            'tenduoi' => '1_3_nu',
            'duoidan' => 'thuvien',
            'products' => $this->sanphamService->getBLocTreEm1_12($request, 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nữ'),
            'phongcachs' => $this->sanphamService->getphongcach(),
            'nhanhieus' => $this->sanphamService->getnhanhieu(),
            'sizes' => $this->sanphamService->getsize(),

        ]);
    }
    public function sanphamthuvien_1_3_nam(){
        return view('web.sanpham.sanpham_hienthiThuVien', [
            'title' => 'Sản Phẩm',
            'ten' => 'SẢN PHẨM',
            'action' => 'ko',
            'ten1' => 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nam',
            'tenduoi' => '1_3_nam',
            'duoidan' => 'thuvien',
            'products' => $this->sanphamService->get_1_3_nam(),
            'phongcachs' => $this->sanphamService->getphongcach(),
            'nhanhieus' => $this->sanphamService->getnhanhieu(),
            'sizes' => $this->sanphamService->getsize(),

        ]);
    }
    public function BL_sanphamthuvien_1_3_nam(sanphamRequest $request){
        return view('web.sanpham.sanpham_hienthiThuVien', [
            'title' => 'Sản Phẩm',
            'ten' => 'SẢN PHẨM',
            'action' => 'ko',
            'ten1' => 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nam',
            'tenduoi' => '1_3_nam',
            'duoidan' => 'thuvien',
            'products' => $this->sanphamService->getBLocTreEm1_12($request, 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nam'),
            'phongcachs' => $this->sanphamService->getphongcach(),
            'nhanhieus' => $this->sanphamService->getnhanhieu(),
            'sizes' => $this->sanphamService->getsize(),

        ]);
    }
    public function sanphamthuvien_3_6_nu(){
        return view('web.sanpham.sanpham_hienthiThuVien', [
            'title' => 'Sản Phẩm',
            'ten' => 'SẢN PHẨM',
            'action' => 'ko',
            'ten1' => 'Trẻ em (3-6) _ trẻ Nữ',
            'tenduoi' => '3_6_nu',
            'duoidan' => 'thuvien',
            'products' => $this->sanphamService->get_3_6_nu(),
            'phongcachs' => $this->sanphamService->getphongcach(),
            'nhanhieus' => $this->sanphamService->getnhanhieu(),
            'sizes' => $this->sanphamService->getsize(),

        ]);
    }
    public function BL_sanphamthuvien_3_6_nu(sanphamRequest $request){
        return view('web.sanpham.sanpham_hienthiThuVien', [
            'title' => 'Sản Phẩm',
            'ten' => 'SẢN PHẨM',
            'action' => 'ko',
            'ten1' => 'Trẻ em (3-6) _ trẻ Nữ',
            'tenduoi' => '3_6_nu',
            'duoidan' => 'thuvien',
            'products' => $this->sanphamService->getBLocTreEm1_12($request, 'Trẻ em (3-6) _ trẻ Nữ'),
            'phongcachs' => $this->sanphamService->getphongcach(),
            'nhanhieus' => $this->sanphamService->getnhanhieu(),
            'sizes' => $this->sanphamService->getsize(),

        ]);
    }
    public function sanphamthuvien_3_6_nam(){
        return view('web.sanpham.sanpham_hienthiThuVien', [
            'title' => 'Sản Phẩm',
            'ten' => 'SẢN PHẨM',
            'action' => 'ko',
            'ten1' => 'Trẻ em (3-6) _ trẻ Nam',
            'tenduoi' => '3_6_nam',
            'duoidan' => 'thuvien',
            'products' => $this->sanphamService->get_3_6_nam(),
            'phongcachs' => $this->sanphamService->getphongcach(),
            'nhanhieus' => $this->sanphamService->getnhanhieu(),
            'sizes' => $this->sanphamService->getsize(),

        ]);
    }
    public function BL_sanphamthuvien_3_6_nam(sanphamRequest $request){
        return view('web.sanpham.sanpham_hienthiThuVien', [
            'title' => 'Sản Phẩm',
            'ten' => 'SẢN PHẨM',
            'action' => 'ko',
            'ten1' => 'Trẻ em (3-6) _ trẻ Nam',
            'tenduoi' => '3_6_nam',
            'duoidan' => 'thuvien',
            'products' => $this->sanphamService->getBLocTreEm1_12($request, 'Trẻ em (3-6) _ trẻ Nam'),
            'phongcachs' => $this->sanphamService->getphongcach(),
            'nhanhieus' => $this->sanphamService->getnhanhieu(),
            'sizes' => $this->sanphamService->getsize(),

        ]);
    }
    public function sanphamthuvien_6_12_nu(){
        return view('web.sanpham.sanpham_hienthiThuVien', [
            'title' => 'Sản Phẩm',
            'ten' => 'SẢN PHẨM',
            'action' => 'ko',
            'ten1' => 'Thanh thiếu niên (6-12) _ trẻ Nữ',
            'tenduoi' => '6_12_nu',
            'duoidan' => 'thuvien',
            'products' => $this->sanphamService->get_6_12_nu(),
            'phongcachs' => $this->sanphamService->getphongcach(),
            'nhanhieus' => $this->sanphamService->getnhanhieu(),
            'sizes' => $this->sanphamService->getsize(),

        ]);
    }
    public function BL_sanphamthuvien_6_12_nu(sanphamRequest $request){
        return view('web.sanpham.sanpham_hienthiThuVien', [
            'title' => 'Sản Phẩm',
            'ten' => 'SẢN PHẨM',
            'action' => 'ko',
            'ten1' => 'Thanh thiếu niên (6-12) _ trẻ Nữ',
            'tenduoi' => '6_12_nu',
            'duoidan' => 'thuvien',
            'products' => $this->sanphamService->getBLocTreEm1_12($request, 'Thanh thiếu niên (6-12) _ trẻ Nữ'),
            'phongcachs' => $this->sanphamService->getphongcach(),
            'nhanhieus' => $this->sanphamService->getnhanhieu(),
            'sizes' => $this->sanphamService->getsize(),

        ]);
    }
    public function sanphamthuvien_6_12_nam(){
        return view('web.sanpham.sanpham_hienthiThuVien', [
            'title' => 'Sản Phẩm',
            'ten' => 'SẢN PHẨM',
            'action' => 'ko',
            'ten1' => 'Thanh thiếu niên (6-12) _ trẻ Nam',
            'tenduoi' => '6_12_nam',
            'duoidan' => 'thuvien',
            'products' => $this->sanphamService->get_6_12_nam(),
            'phongcachs' => $this->sanphamService->getphongcach(),
            'nhanhieus' => $this->sanphamService->getnhanhieu(),
            'sizes' => $this->sanphamService->getsize(),

        ]);
    }
    public function BL_sanphamthuvien_6_12_nam(sanphamRequest $request){
        return view('web.sanpham.sanpham_hienthiThuVien', [
            'title' => 'Sản Phẩm',
            'ten' => 'SẢN PHẨM',
            'action' => 'ko',
            'ten1' => 'Thanh thiếu niên (6-12) _ trẻ Nam',
            'tenduoi' => '6_12_nam',
            'duoidan' => 'thuvien',
            'products' => $this->sanphamService->getBLocTreEm1_12($request, 'Thanh thiếu niên (6-12) _ trẻ Nam'),
            'phongcachs' => $this->sanphamService->getphongcach(),
            'nhanhieus' => $this->sanphamService->getnhanhieu(),
            'sizes' => $this->sanphamService->getsize(),

        ]);
    }


    public function sanphamdanhsach()
    {
//        echo '1234';
        return view('web.sanpham.sanpham_hienthiDanhSach', [
            'title' => 'Sản Phẩm',
            'ten' => 'SẢN PHẨM',
            'action' => 'ko',
            'duoidan' => 'danhsach',
            'products' => $this->sanphamService->getAll(),
            'phongcachs' => $this->sanphamService->getphongcach(),
            'nhanhieus' => $this->sanphamService->getnhanhieu(),
            'sizes' => $this->sanphamService->getsize(),

        ]);
    }
    public function BL_sanphamdanhsach(sanphamRequest $request)
    {
//        dd($request->input());

//        echo '1234';
        return view('web.sanpham.sanpham_hienthiDanhSach', [
            'title' => 'Sản Phẩm',
            'ten' => 'SẢN PHẨM',
            'action' => 'ko',
            'duoidan' => 'danhsach',
            'products' => $this->sanphamService->getBLoc($request),
            'phongcachs' => $this->sanphamService->getphongcach(),
            'nhanhieus' => $this->sanphamService->getnhanhieu(),
            'sizes' => $this->sanphamService->getsize(),

        ]);
    }
    public function sanphamdanhsach_nam(){
        return view('web.sanpham.sanpham_hienthiDanhSach', [
            'title' => 'Sản Phẩm',
            'ten' => 'SẢN PHẨM',
            'ten1' => 'Nam',
            'tenduoi' => 'Nam',
            'duoidan' => 'danhsach',
            'products' => $this->sanphamService->getnam(),
            'phongcachs' => $this->sanphamService->getphongcach(),
            'nhanhieus' => $this->sanphamService->getnhanhieu(),
            'sizes' => $this->sanphamService->getsize(),

        ]);
    }
    public function BL_sanphamdanhsach_nam(sanphamRequest $request)
    {
//        dd($request->input());
//        echo '1234';
        return view('web.sanpham.sanpham_hienthiDanhSach', [
            'title' => 'Sản Phẩm',
            'ten' => 'SẢN PHẨM',
            'action' => 'ko',
            'ten1' => 'Nam',
            'tenduoi' => 'Nam',
            'duoidan' => 'danhsach',
            'products' => $this->sanphamService->getBLoc_nam($request),
            'phongcachs' => $this->sanphamService->getphongcach(),
            'nhanhieus' => $this->sanphamService->getnhanhieu(),
            'sizes' => $this->sanphamService->getsize(),

        ]);
    }
    public function sanphamdanhsach_nu(){
        return view('web.sanpham.sanpham_hienthiDanhSach', [
            'title' => 'Sản Phẩm',
            'ten' => 'SẢN PHẨM',
            'action' => 'ko',
            'ten1' => 'Nu',
            'tenduoi' => 'Nu',
            'duoidan' => 'danhsach',
            'products' => $this->sanphamService->getnu(),
            'phongcachs' => $this->sanphamService->getphongcach(),
            'nhanhieus' => $this->sanphamService->getnhanhieu(),
            'sizes' => $this->sanphamService->getsize(),

        ]);
    }
    public function BL_sanphamdanhsach_nu(sanphamRequest $request)
    {
//        dd($request->input());
//        echo '1234';
        return view('web.sanpham.sanpham_hienthiDanhSach', [
            'title' => 'Sản Phẩm',
            'ten' => 'SẢN PHẨM',
            'ten1' => 'Nu',
            'action' => 'ko',
            'tenduoi' => 'Nu',
            'duoidan' => 'danhsach',
            'products' => $this->sanphamService->getBLoc_nu($request),
            'phongcachs' => $this->sanphamService->getphongcach(),
            'nhanhieus' => $this->sanphamService->getnhanhieu(),
            'sizes' => $this->sanphamService->getsize(),

        ]);
    }
    public function sanphamdanhsach_treem(){

//        dd($request->input());
//        echo '1234';
        return view('web.sanpham.sanpham_hienthiDanhSach', [
            'title' => 'Sản Phẩm',
            'ten' => 'SẢN PHẨM',
            'action' => 'ko',
            'ten1' => 'Tre_em',
            'tenduoi' => 'Tre_em',
            'duoidan' => 'danhsach',
            'products' => $this->sanphamService->gettreeem(),
            'phongcachs' => $this->sanphamService->getphongcach(),
            'nhanhieus' => $this->sanphamService->getnhanhieu(),
            'sizes' => $this->sanphamService->getsize(),

        ]);
    }
    public function BL_sanphamdanhsach_treem(sanphamRequest $request){

//        dd($request->input());
//        echo '1234';
        return view('web.sanpham.sanpham_hienthiDanhSach', [
            'title' => 'Sản Phẩm',
            'ten' => 'SẢN PHẨM',
            'ten1' => 'Tre_em',
            'tenduoi' => 'Tre_em',
            'action' => 'ko',
            'duoidan' => 'danhsach',
            'products' => $this->sanphamService->getBLoc_treem($request),
            'phongcachs' => $this->sanphamService->getphongcach(),
            'nhanhieus' => $this->sanphamService->getnhanhieu(),
            'sizes' => $this->sanphamService->getsize(),

        ]);
    }
    public function sanphamdanhsach_1_3_nu(){
        return view('web.sanpham.sanpham_hienthiDanhSach', [
            'title' => 'Sản Phẩm',
            'ten' => 'SẢN PHẨM',
            'action' => 'ko',
            'ten1' => 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nữ',
            'tenduoi' => '1_3_nu',
            'duoidan' => 'danhsach',
            'products' => $this->sanphamService->get_1_3_nu(),
            'phongcachs' => $this->sanphamService->getphongcach(),
            'nhanhieus' => $this->sanphamService->getnhanhieu(),
            'sizes' => $this->sanphamService->getsize(),

        ]);
    }
    public function BL_sanphamdanhsach_1_3_nu(sanphamRequest $request){
        return view('web.sanpham.sanpham_hienthiDanhSach', [
            'title' => 'Sản Phẩm',
            'ten' => 'SẢN PHẨM',
            'action' => 'ko',
            'ten1' => 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nữ',
            'tenduoi' => '1_3_nu',
            'duoidan' => 'danhsach',
            'products' => $this->sanphamService->getBLocTreEm1_12($request, 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nữ'),
            'phongcachs' => $this->sanphamService->getphongcach(),
            'nhanhieus' => $this->sanphamService->getnhanhieu(),
            'sizes' => $this->sanphamService->getsize(),

        ]);
    }
    public function sanphamdanhsach_1_3_nam(){
        return view('web.sanpham.sanpham_hienthiDanhSach', [
            'title' => 'Sản Phẩm',
            'ten' => 'SẢN PHẨM',
            'action' => 'ko',
            'ten1' => 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nam',
            'tenduoi' => '1_3_nam',
            'duoidan' => 'danhsach',
            'products' => $this->sanphamService->get_1_3_nam(),
            'phongcachs' => $this->sanphamService->getphongcach(),
            'nhanhieus' => $this->sanphamService->getnhanhieu(),
            'sizes' => $this->sanphamService->getsize(),

        ]);
    }
    public function BL_sanphamdanhsach_1_3_nam(sanphamRequest $request){
        return view('web.sanpham.sanpham_hienthiDanhSach', [
            'title' => 'Sản Phẩm',
            'ten' => 'SẢN PHẨM',
            'action' => 'ko',
            'ten1' => 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nam',
            'tenduoi' => '1_3_nam',
            'duoidan' => 'danhsach',
            'products' => $this->sanphamService->getBLocTreEm1_12($request, 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nam'),
            'phongcachs' => $this->sanphamService->getphongcach(),
            'nhanhieus' => $this->sanphamService->getnhanhieu(),
            'sizes' => $this->sanphamService->getsize(),

        ]);
    }
    public function sanphamdanhsach_3_6_nu(){
        return view('web.sanpham.sanpham_hienthiDanhSach', [
            'title' => 'Sản Phẩm',
            'ten' => 'SẢN PHẨM',
            'action' => 'ko',
            'ten1' => 'Trẻ em (3-6) _ trẻ Nữ',
            'tenduoi' => '3_6_nu',
            'duoidan' => 'danhsach',
            'products' => $this->sanphamService->get_3_6_nu(),
            'phongcachs' => $this->sanphamService->getphongcach(),
            'nhanhieus' => $this->sanphamService->getnhanhieu(),
            'sizes' => $this->sanphamService->getsize(),

        ]);
    }
    public function BL_sanphamdanhsach_3_6_nu(sanphamRequest $request){
        return view('web.sanpham.sanpham_hienthiDanhSach', [
            'title' => 'Sản Phẩm',
            'ten' => 'SẢN PHẨM',
            'action' => 'ko',
            'ten1' => 'Trẻ em (3-6) _ trẻ Nữ',
            'tenduoi' => '3_6_nu',
            'duoidan' => 'danhsach',
            'products' => $this->sanphamService->getBLocTreEm1_12($request, 'Trẻ em (3-6) _ trẻ Nữ'),
            'phongcachs' => $this->sanphamService->getphongcach(),
            'nhanhieus' => $this->sanphamService->getnhanhieu(),
            'sizes' => $this->sanphamService->getsize(),

        ]);
    }
    public function sanphamdanhsach_3_6_nam(){
        return view('web.sanpham.sanpham_hienthiDanhSach', [
            'title' => 'Sản Phẩm',
            'ten' => 'SẢN PHẨM',
            'ten1' => 'Trẻ em (3-6) _ trẻ Nam',
            'action' => 'ko',
            'tenduoi' => '3_6_nam',
            'duoidan' => 'danhsach',
            'products' => $this->sanphamService->get_3_6_nam(),
            'phongcachs' => $this->sanphamService->getphongcach(),
            'nhanhieus' => $this->sanphamService->getnhanhieu(),
            'sizes' => $this->sanphamService->getsize(),

        ]);
    }
    public function BL_sanphamdanhsach_3_6_nam(sanphamRequest $request){
        return view('web.sanpham.sanpham_hienthiDanhSach', [
            'title' => 'Sản Phẩm',
            'ten' => 'SẢN PHẨM',
            'action' => 'ko',
            'ten1' => 'Trẻ em (3-6) _ trẻ Nam',
            'tenduoi' => '3_6_nam',
            'duoidan' => 'danhsach',
            'products' => $this->sanphamService->getBLocTreEm1_12($request, 'Trẻ em (3-6) _ trẻ Nam'),
            'phongcachs' => $this->sanphamService->getphongcach(),
            'nhanhieus' => $this->sanphamService->getnhanhieu(),
            'sizes' => $this->sanphamService->getsize(),

        ]);
    }
    public function sanphamdanhsach_6_12_nu(){
        return view('web.sanpham.sanpham_hienthiDanhSach', [
            'title' => 'Sản Phẩm',
            'ten' => 'SẢN PHẨM',
            'ten1' => 'Thanh thiếu niên (6-12) _ trẻ Nữ',
            'tenduoi' => '6_12_nu',
            'action' => 'ko',
            'duoidan' => 'danhsach',
            'products' => $this->sanphamService->get_6_12_nu(),
            'phongcachs' => $this->sanphamService->getphongcach(),
            'nhanhieus' => $this->sanphamService->getnhanhieu(),
            'sizes' => $this->sanphamService->getsize(),

        ]);
    }
    public function BL_sanphamdanhsach_6_12_nu(sanphamRequest $request){
        return view('web.sanpham.sanpham_hienthiDanhSach', [
            'title' => 'Sản Phẩm',
            'ten' => 'SẢN PHẨM',
            'ten1' => 'Thanh thiếu niên (6-12) _ trẻ Nữ',
            'action' => 'ko',
            'tenduoi' => '6_12_nu',
            'duoidan' => 'danhsach',
            'products' => $this->sanphamService->getBLocTreEm1_12($request, 'Thanh thiếu niên (6-12) _ trẻ Nữ'),
            'phongcachs' => $this->sanphamService->getphongcach(),
            'nhanhieus' => $this->sanphamService->getnhanhieu(),
            'sizes' => $this->sanphamService->getsize(),

        ]);
    }
    public function sanphamdanhsach_6_12_nam(){
        return view('web.sanpham.sanpham_hienthiDanhSach', [
            'title' => 'Sản Phẩm',
            'ten' => 'SẢN PHẨM',
            'ten1' => 'Thanh thiếu niên (6-12) _ trẻ Nam',
            'tenduoi' => '6_12_nam',
            'action' => 'ko',
            'duoidan' => 'danhsach',
            'products' => $this->sanphamService->get_6_12_nam(),
            'phongcachs' => $this->sanphamService->getphongcach(),
            'nhanhieus' => $this->sanphamService->getnhanhieu(),
            'sizes' => $this->sanphamService->getsize(),

        ]);
    }
    public function BL_sanphamdanhsach_6_12_nam(sanphamRequest $request){
        return view('web.sanpham.sanpham_hienthiDanhSach', [
            'title' => 'Sản Phẩm',
            'ten' => 'SẢN PHẨM',
            'action' => 'ko',
            'ten1' => 'Thanh thiếu niên (6-12) _ trẻ Nam',
            'tenduoi' => '6_12_nam',
            'duoidan' => 'danhsach',
            'products' => $this->sanphamService->getBLocTreEm1_12($request, 'Thanh thiếu niên (6-12) _ trẻ Nam'),
            'phongcachs' => $this->sanphamService->getphongcach(),
            'nhanhieus' => $this->sanphamService->getnhanhieu(),
            'sizes' => $this->sanphamService->getsize(),

        ]);
    }



    public function sanphambang()
    {
//        echo '1234';
        return view('web.sanpham.sanpham_hienthibang', [
            'title' => 'Sản Phẩm',
            'ten' => 'SẢN PHẨM',
            'duoidan' => 'bang',
            'action' => 'ko',
            'products' => $this->sanphamService->getAll(),
            'phongcachs' => $this->sanphamService->getphongcach(),
            'nhanhieus' => $this->sanphamService->getnhanhieu(),
            'sizes' => $this->sanphamService->getsize(),

        ]);
    }
    public function BL_sanphambang(sanphamRequest $request)
    {
//        dd($request->input());

//        echo '1234';
        return view('web.sanpham.sanpham_hienthibang', [
            'title' => 'Sản Phẩm',
            'ten' => 'SẢN PHẨM',
            'action' => 'ko',
            'duoidan' => 'bang',
            'products' => $this->sanphamService->getBLoc($request),
            'phongcachs' => $this->sanphamService->getphongcach(),
            'nhanhieus' => $this->sanphamService->getnhanhieu(),
            'sizes' => $this->sanphamService->getsize(),

        ]);
    }
    public function sanphambang_nam(){
        return view('web.sanpham.sanpham_hienthibang', [
            'title' => 'Sản Phẩm',
            'ten' => 'SẢN PHẨM',
            'ten1' => 'Nam',
            'action' => 'ko',
            'tenduoi' => 'Nam',
            'duoidan' => 'bang',
            'products' => $this->sanphamService->getnam(),
            'phongcachs' => $this->sanphamService->getphongcach(),
            'nhanhieus' => $this->sanphamService->getnhanhieu(),
            'sizes' => $this->sanphamService->getsize(),

        ]);
    }
    public function BL_sanphambang_nam(sanphamRequest $request)
    {
//        dd($request->input());
//        echo '1234';
        return view('web.sanpham.sanpham_hienthibang', [
            'title' => 'Sản Phẩm',
            'ten' => 'SẢN PHẨM',
            'ten1' => 'Nam',
            'action' => 'ko',
            'tenduoi' => 'Nam',
            'duoidan' => 'bang',
            'products' => $this->sanphamService->getBLoc_nam($request),
            'phongcachs' => $this->sanphamService->getphongcach(),
            'nhanhieus' => $this->sanphamService->getnhanhieu(),
            'sizes' => $this->sanphamService->getsize(),

        ]);
    }
    public function sanphambang_nu(){
        return view('web.sanpham.sanpham_hienthibang', [
            'title' => 'Sản Phẩm',
            'ten' => 'SẢN PHẨM',
            'ten1' => 'Nu',
            'action' => 'ko',
            'tenduoi' => 'Nu',
            'duoidan' => 'bang',
            'products' => $this->sanphamService->getnu(),
            'phongcachs' => $this->sanphamService->getphongcach(),
            'nhanhieus' => $this->sanphamService->getnhanhieu(),
            'sizes' => $this->sanphamService->getsize(),

        ]);
    }
    public function BL_sanphambang_nu(sanphamRequest $request)
    {
//        dd($request->input());
//        echo '1234';
        return view('web.sanpham.sanpham_hienthibang', [
            'title' => 'Sản Phẩm',
            'ten' => 'SẢN PHẨM',
            'ten1' => 'Nu',
            'action' => 'ko',
            'tenduoi' => 'Nu',
            'duoidan' => 'bang',
            'products' => $this->sanphamService->getBLoc_nu($request),
            'phongcachs' => $this->sanphamService->getphongcach(),
            'nhanhieus' => $this->sanphamService->getnhanhieu(),
            'sizes' => $this->sanphamService->getsize(),

        ]);
    }
    public function sanphambang_treem(){
        return view('web.sanpham.sanpham_hienthibang', [
            'title' => 'Sản Phẩm',
            'ten' => 'SẢN PHẨM',
            'action' => 'ko',
            'ten1' => 'Tre_em',
            'tenduoi' => 'Tre_em',
            'duoidan' => 'bang',
            'products' => $this->sanphamService->gettreeem(),
            'phongcachs' => $this->sanphamService->getphongcach(),
            'nhanhieus' => $this->sanphamService->getnhanhieu(),
            'sizes' => $this->sanphamService->getsize(),
        ]);
    }
    public function BL_sanphambang_treem(sanphamRequest $request)
    {
//        dd($request->input());
//        echo '1234';
        return view('web.sanpham.sanpham_hienthibang', [
            'title' => 'Sản Phẩm',
            'ten' => 'SẢN PHẨM',
            'ten1' => 'Tre_em',
            'action' => 'ko',
            'tenduoi' => 'Tre_em',
            'duoidan' => 'bang',
            'products' => $this->sanphamService->getBLoc_treem($request),
            'phongcachs' => $this->sanphamService->getphongcach(),
            'nhanhieus' => $this->sanphamService->getnhanhieu(),
            'sizes' => $this->sanphamService->getsize(),

        ]);
    }
    public function sanphambang_1_3_nu(){
        return view('web.sanpham.sanpham_hienthibang', [
            'title' => 'Sản Phẩm',
            'ten' => 'SẢN PHẨM',
            'ten1' => 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nữ',
            'tenduoi' => '1_3_nu',
            'action' => 'ko',
            'duoidan' => 'bang',
            'products' => $this->sanphamService->get_1_3_nu(),
            'phongcachs' => $this->sanphamService->getphongcach(),
            'nhanhieus' => $this->sanphamService->getnhanhieu(),
            'sizes' => $this->sanphamService->getsize(),
        ]);
    }
    public function BL_sanphambang_1_3_nu(sanphamRequest $request){
        return view('web.sanpham.sanpham_hienthibang', [
            'title' => 'Sản Phẩm',
            'ten' => 'SẢN PHẨM',
            'action' => 'ko',
            'ten1' => 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nữ',
            'tenduoi' => '1_3_nu',
            'duoidan' => 'bang',
            'products' => $this->sanphamService->getBLocTreEm1_12($request, 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nữ'),
            'phongcachs' => $this->sanphamService->getphongcach(),
            'nhanhieus' => $this->sanphamService->getnhanhieu(),
            'sizes' => $this->sanphamService->getsize(),

        ]);
    }
    public function sanphambang_1_3_nam(){
        return view('web.sanpham.sanpham_hienthibang', [
            'title' => 'Sản Phẩm',
            'ten' => 'SẢN PHẨM',
            'action' => 'ko',
            'ten1' => 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nam',
            'tenduoi' => '1_3_nam',
            'duoidan' => 'bang',
            'products' => $this->sanphamService->get_1_3_nam(),
            'phongcachs' => $this->sanphamService->getphongcach(),
            'nhanhieus' => $this->sanphamService->getnhanhieu(),
            'sizes' => $this->sanphamService->getsize(),
        ]);
    }
    public function BL_sanphambang_1_3_nam(sanphamRequest $request){
        return view('web.sanpham.sanpham_hienthibang', [
            'title' => 'Sản Phẩm',
            'ten' => 'SẢN PHẨM',
            'action' => 'ko',
            'ten1' => 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nam',
            'tenduoi' => '1_3_nam',
            'duoidan' => 'bang',
            'products' => $this->sanphamService->getBLocTreEm1_12($request, 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nam'),
            'phongcachs' => $this->sanphamService->getphongcach(),
            'nhanhieus' => $this->sanphamService->getnhanhieu(),
            'sizes' => $this->sanphamService->getsize(),

        ]);
    }
    public function sanphambang_3_6_nu(){
        return view('web.sanpham.sanpham_hienthibang', [
            'title' => 'Sản Phẩm',
            'ten' => 'SẢN PHẨM',
            'action' => 'ko',
            'ten1' => 'Trẻ em (3-6) _ trẻ Nữ',
            'tenduoi' => '3_6_nu',
            'duoidan' => 'bang',
            'products' => $this->sanphamService->get_3_6_nu(),
            'phongcachs' => $this->sanphamService->getphongcach(),
            'nhanhieus' => $this->sanphamService->getnhanhieu(),
            'sizes' => $this->sanphamService->getsize(),
        ]);
    }
    public function BL_sanphambang_3_6_nu(sanphamRequest $request){
        return view('web.sanpham.sanpham_hienthibang', [
            'title' => 'Sản Phẩm',
            'ten' => 'SẢN PHẨM',
            'ten1' => 'Trẻ em (3-6) _ trẻ Nữ',
            'action' => 'ko',
            'tenduoi' => '3_6_nu',
            'duoidan' => 'bang',
            'products' => $this->sanphamService->getBLocTreEm1_12($request, 'Trẻ em (3-6) _ trẻ Nữ'),
            'phongcachs' => $this->sanphamService->getphongcach(),
            'nhanhieus' => $this->sanphamService->getnhanhieu(),
            'sizes' => $this->sanphamService->getsize(),

        ]);
    }
    public function sanphambang_3_6_nam(){
        return view('web.sanpham.sanpham_hienthibang', [
            'title' => 'Sản Phẩm',
            'ten' => 'SẢN PHẨM',
            'action' => 'ko',
            'ten1' => 'Trẻ em (3-6) _ trẻ Nam',
            'tenduoi' => '3_6_nam',
            'duoidan' => 'bang',
            'products' => $this->sanphamService->get_3_6_nam(),
            'phongcachs' => $this->sanphamService->getphongcach(),
            'nhanhieus' => $this->sanphamService->getnhanhieu(),
            'sizes' => $this->sanphamService->getsize(),
        ]);
    }
    public function BL_sanphambang_3_6_nam(sanphamRequest $request){
        return view('web.sanpham.sanpham_hienthibang', [
            'title' => 'Sản Phẩm',
            'ten' => 'SẢN PHẨM',
            'action' => 'ko',
            'ten1' => 'Trẻ em (3-6) _ trẻ Nam',
            'tenduoi' => '3_6_nam',
            'duoidan' => 'bang',
            'products' => $this->sanphamService->getBLocTreEm1_12($request, 'Trẻ em (3-6) _ trẻ Nam'),
            'phongcachs' => $this->sanphamService->getphongcach(),
            'nhanhieus' => $this->sanphamService->getnhanhieu(),
            'sizes' => $this->sanphamService->getsize(),

        ]);
    }
    public function sanphambang_6_12_nu(){
        return view('web.sanpham.sanpham_hienthibang', [
            'title' => 'Sản Phẩm',
            'ten' => 'SẢN PHẨM',
            'action' => 'ko',
            'ten1' => 'Thanh thiếu niên (6-12) _ trẻ Nữ',
            'tenduoi' => '6_12_nu',
            'duoidan' => 'bang',
            'products' => $this->sanphamService->get_6_12_nu(),
            'phongcachs' => $this->sanphamService->getphongcach(),
            'nhanhieus' => $this->sanphamService->getnhanhieu(),
            'sizes' => $this->sanphamService->getsize(),
        ]);
    }
    public function BL_sanphambang_6_12_nu(sanphamRequest $request){
        return view('web.sanpham.sanpham_hienthibang', [
            'title' => 'Sản Phẩm',
            'ten' => 'SẢN PHẨM',
            'ten1' => 'Thanh thiếu niên (6-12) _ trẻ Nữ',
            'action' => 'ko',
            'tenduoi' => '6_12_nu',
            'duoidan' => 'bang',
            'products' => $this->sanphamService->getBLocTreEm1_12($request, 'Thanh thiếu niên (6-12) _ trẻ Nữ'),
            'phongcachs' => $this->sanphamService->getphongcach(),
            'nhanhieus' => $this->sanphamService->getnhanhieu(),
            'sizes' => $this->sanphamService->getsize(),

        ]);
    }
    public function sanphambang_6_12_nam(){
        return view('web.sanpham.sanpham_hienthibang', [
            'title' => 'Sản Phẩm',
            'action' => 'ko',
            'ten' => 'SẢN PHẨM',
            'ten1' => 'Thanh thiếu niên (6-12) _ trẻ Nam',
            'tenduoi' => '6_12_nam',
            'duoidan' => 'bang',
            'products' => $this->sanphamService->get_6_12_nam(),
            'phongcachs' => $this->sanphamService->getphongcach(),
            'nhanhieus' => $this->sanphamService->getnhanhieu(),
            'sizes' => $this->sanphamService->getsize(),
        ]);
    }
    public function BL_sanphambang_6_12_nam(sanphamRequest $request){
        return view('web.sanpham.sanpham_hienthibang', [
            'title' => 'Sản Phẩm',
            'ten' => 'SẢN PHẨM',
            'action' => 'ko',
            'ten1' => 'Thanh thiếu niên (6-12) _ trẻ Nam',
            'tenduoi' => '6_12_nam',
            'duoidan' => 'bang',
            'products' => $this->sanphamService->getBLocTreEm1_12($request, 'Thanh thiếu niên (6-12) _ trẻ Nam'),
            'phongcachs' => $this->sanphamService->getphongcach(),
            'nhanhieus' => $this->sanphamService->getnhanhieu(),
            'sizes' => $this->sanphamService->getsize(),

        ]);
    }



    public function NDsanphan(Product $idSP){
//        echo '123';
//        dd($this->sanphamService->getyeuthich( Auth::user()->id, $idSP->id));
        return view('web.sanpham.NDsanphan',[
            'title'=>'Chi tiết sản phẩm',
            'SPs' => $idSP,
            'yeuthichs' => $this->sanphamService->getyeuthich(Auth::user()->id, $idSP->id),
            'loais' => $this->sanphamService->getCLoai($idSP->name),
            'SPTTs' => $this->sanphamService->SPTT($idSP->size1, $idSP->size2, $idSP->size3, $idSP->size4, $idSP->size5, $idSP->size6, $idSP->theloai),
        ]);
    }

    public function binhluan(Product $idSP, Request $request){
        dd($request->input());
    }



}
