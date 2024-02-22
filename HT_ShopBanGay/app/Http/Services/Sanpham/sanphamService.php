<?php

namespace App\Http\Services\Sanpham;

use App\Models\Product;
use App\Models\Nhanhieu;
use App\Models\size;
use App\Models\theloai;
use App\Models\Yeuthich;

class sanphamService
{
    public function getAll(){
        return Product::orderbyDesc('id')->paginate(24);
    }
    public function getphongcach(){
        return theloai::orderbyDesc('id')->paginate(100);
    }
    public function getnhanhieu(){
        return Nhanhieu::orderbyDesc('id')->simplePaginate(100);
    }
    public function getsize(){
        return size::orderbyDesc('id')->simplePaginate(100);
    }
    public function getnam(){
        return Product::where('menu_name1', 'Nam')->paginate(24);
    }
    public function getnu(){
        return Product::where('menu_name1', 'Nữ')->paginate(24);
    }
    public function gettreeem(){
        return Product::where('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nữ')
            ->orwhere('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nam')
            ->orwhere('menu_name1', 'Trẻ em (3-6) _ trẻ Nữ')
            ->orwhere('menu_name1', 'Trẻ em (3-6) _ trẻ Nam')
            ->orwhere('menu_name1', 'Thanh thiếu niên (6-12) _ trẻ Nữ')
            ->orwhere('menu_name1', 'Thanh thiếu niên (8-16) _ trẻ Nam')->paginate(24);
    }
    public function get_1_3_nu(){
        return Product::where('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nữ')->paginate(24);
    }
    public function get_1_3_nam(){
        return Product::where('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nam')->paginate(24);
    }
    public function get_3_6_nu(){
        return Product::where('menu_name1', 'Trẻ em (3-6) _ trẻ Nữ')->paginate(24);
    }
    public function get_3_6_nam(){
        return Product::where('menu_name1', 'Trẻ em (3-6) _ trẻ Nam')->paginate(24);
    }
    public function get_6_12_nu(){
        return Product::where('menu_name1', 'Thanh thiếu niên (6-12) _ trẻ Nữ')->paginate(24);
    }
    public function get_6_12_nam(){
        return Product::where('menu_name1', 'Thanh thiếu niên (6-12) _ trẻ Nam')->paginate(24);
    }
    public function getSPGG(){
        return Product::where('money_sale', '!=', 0)->paginate(24);
    }

    public function getBLoc($request)
    {
//        $theloai_Di_choi = null;
//        $theloai_The_thao = null;
//        $theloai_Van_phong = null;

        $money = $request->input('money');
        $tien = explode(";", $money);

        $theloai_Di_choi = $request->input('theloai_3');
        $theloai_The_thao = $request->input('theloai_1');
        $theloai_Van_phong = $request->input('theloai_2');

        $nhanhieu = $request->input('nhanhieu');
        $size = $request->input('size');

//        s
        if ($nhanhieu == 'null' &&
            $size == 'null' &&
            $theloai_The_thao == null &&
            $theloai_Van_phong == null &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                            ->where('money', '<=', $tien[1])->paginate(24);
        }


//        s
        if ($nhanhieu == 'null' &&
            $size == 'null' &&
            $theloai_The_thao == null &&
            $theloai_Van_phong == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);
        }
//        s
        if ($nhanhieu == 'null' &&
            $size == 'null' &&
            $theloai_The_thao == null &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('theloai', '=', $theloai_Van_phong)->paginate(24);
        }
//        s
        if ($nhanhieu == 'null' &&
            $size == 'null' &&
            $theloai_Van_phong == null &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('theloai', '=', $theloai_The_thao)->paginate(24);
        }
//        s
        if ($nhanhieu == 'null' &&
            $theloai_The_thao == null &&
            $theloai_Van_phong == null &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })->paginate(24);
        }
//        s
        if ($size == 'null' &&
            $theloai_The_thao == null &&
            $theloai_Van_phong == null &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('nhanhieu', '=', $nhanhieu)->paginate(24);
        }

//        s
        if ($theloai_The_thao == null &&
            $theloai_Van_phong == null &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('nhanhieu', '=', $nhanhieu)
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })->paginate(24);
        }
//        s
        if ($size == 'null' &&
            $theloai_Van_phong == null &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('nhanhieu', '=', $nhanhieu)
                ->where('theloai', '=', $theloai_The_thao)->paginate(24);
        }
//        s
        if ($size == 'null' &&
            $theloai_The_thao == null &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('nhanhieu', '=', $nhanhieu)
                ->where('theloai', '=', $theloai_Van_phong)->paginate(24);
        }
//        s
        if ($size == 'null' &&
            $theloai_The_thao == null &&
            $theloai_Van_phong == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('nhanhieu', '=', $nhanhieu)
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);
        }

//        s
        if ($nhanhieu == 'null' &&
            $theloai_Van_phong == null &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })
                ->where('theloai', '=', $theloai_The_thao)->paginate(24);
        }
//        s
        if ($nhanhieu == 'null' &&
            $theloai_The_thao == null &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })
                ->where('theloai', '=', $theloai_Van_phong)->paginate(24);
        }
//        s
        if ($nhanhieu == 'null' &&
            $theloai_The_thao == null &&
            $theloai_Van_phong == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);
        }

//        s
        if ($nhanhieu == 'null' &&
            $size == 'null' &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('theloai', '=', $theloai_The_thao)
                ->where('theloai', '=', $theloai_Van_phong)->paginate(24);
        }
//        s
        if ($nhanhieu == 'null' &&
            $size == 'null' &&
            $theloai_Van_phong == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('theloai', '=', $theloai_The_thao)
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);
        }

//        s
        if ($nhanhieu == 'null' &&
            $size == 'null' &&
            $theloai_The_thao == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('theloai', '=', $theloai_Van_phong)
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);
        }

//        s
        if ($theloai_Van_phong == null &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('nhanhieu', '=', $nhanhieu)
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })
                ->where('theloai', '=', $theloai_The_thao)->paginate(24);
        }
//        s
        if ($theloai_The_thao == null &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('nhanhieu', '=', $nhanhieu)
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })
                ->where('theloai', '=', $theloai_Van_phong)->paginate(24);
        }
//        s
        if ($theloai_The_thao == null &&
            $theloai_Van_phong == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('nhanhieu', '=', $nhanhieu)
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);
        }
//        s
        if ($size == 'null' &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('nhanhieu', '=', $nhanhieu)
                ->where('theloai', '=', $theloai_The_thao)
                ->where('theloai', '=', $theloai_Van_phong)->paginate(24);
        }
//        s
        if ($size == 'null' &&
            $theloai_Van_phong == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('nhanhieu', '=', $nhanhieu)
                ->where('theloai', '=', $theloai_The_thao)
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);
        }
//        s
        if ($size == 'null' &&
            $theloai_The_thao == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('nhanhieu', '=', $nhanhieu)
                ->where('theloai', '=', $theloai_Van_phong)
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);
        }
//        s
        if ($nhanhieu == 'null' &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })
                ->where('theloai', '=', $theloai_The_thao)
                ->where('theloai', '=', $theloai_Van_phong)->paginate(24);
        }
//        s
        if ($nhanhieu == 'null' &&
            $theloai_Van_phong == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })
                ->where('theloai', '=', $theloai_The_thao)
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);
        }
//        s
        if ($nhanhieu == 'null' &&
            $theloai_The_thao == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })
                ->where('theloai', '=', $theloai_Van_phong)
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);
        }
//        s
        if ($nhanhieu == 'null' &&
            $size == 'null') {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('theloai', '=', $theloai_The_thao)
                ->where('theloai', '=', $theloai_Van_phong)
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);
        }
//        s
        if ($nhanhieu == 'null') {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })
                ->where('theloai', '=', $theloai_The_thao)
                ->where('theloai', '=', $theloai_Van_phong)
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);

        }
//        s
        if ( $size == 'null') {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('nhanhieu', '=', $nhanhieu)
                ->where('theloai', '=', $theloai_The_thao)
                ->where('theloai', '=', $theloai_Van_phong)
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);
        }
//        s
        if ($theloai_The_thao == null){
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('nhanhieu', '=', $nhanhieu)
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })
                ->where('theloai', '=', $theloai_Van_phong)
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);

        }
//        s
        if ($theloai_Van_phong == null){
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('nhanhieu', '=', $nhanhieu)
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })
                ->where('theloai', '=', $theloai_The_thao)
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);

        }
//        s
        if ( $theloai_Di_choi == null){
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('nhanhieu', '=', $nhanhieu)
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })
                ->where('theloai', '=', $theloai_The_thao)
                ->where('theloai', '=', $theloai_Van_phong)->paginate(24);

        }
        return Product::where('money', '>=', $tien[0])
            ->where('money', '<=', $tien[1])
            ->where('nhanhieu', '=', $nhanhieu)
            ->where(function ($query) use ($size) {
                return $query
                    ->where('size1', '=', $size)
                    ->orwhere('size2', '=', $size)
                    ->orwhere('size3', '=', $size)
                    ->orwhere('size4', '=', $size)
                    ->orwhere('size5', '=', $size)
                    ->orwhere('size6', '=', $size);
            })
            ->where('theloai', '=', $theloai_The_thao)
            ->where('theloai', '=', $theloai_Van_phong)
            ->where('theloai', '=', $theloai_Di_choi)->paginate(24);

    }

    public function getBLoc_nam($request)
    {
//        $theloai_Di_choi = null;
//        $theloai_The_thao = null;
//        $theloai_Van_phong = null;

        $money = $request->input('money');
        $tien = explode(";", $money);

        $theloai_Di_choi = $request->input('theloai_3');
        $theloai_The_thao = $request->input('theloai_1');
        $theloai_Van_phong = $request->input('theloai_2');

        $nhanhieu = $request->input('nhanhieu');
        $size = $request->input('size');
        $nam = 'nam';

//        s
        if ($nhanhieu == 'null' &&
            $size == 'null' &&
            $theloai_The_thao == null &&
            $theloai_Van_phong == null &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', 'Nam')->paginate(24);
        }


//        s
        if ($nhanhieu == 'null' &&
            $size == 'null' &&
            $theloai_The_thao == null &&
            $theloai_Van_phong == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);
        }
//        s
        if ($nhanhieu == 'null' &&
            $size == 'null' &&
            $theloai_The_thao == null &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where('theloai', '=', $theloai_Van_phong)->paginate(24);
        }
//        s
        if ($nhanhieu == 'null' &&
            $size == 'null' &&
            $theloai_Van_phong == null &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where('theloai', '=', $theloai_The_thao)->paginate(24);
        }
//        s
        if ($nhanhieu == 'null' &&
            $theloai_The_thao == null &&
            $theloai_Van_phong == null &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })->paginate(24);
        }
//        s
        if ($size == 'null' &&
            $theloai_The_thao == null &&
            $theloai_Van_phong == null &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where('nhanhieu', '=', $nhanhieu)->paginate(24);
        }

//        s
        if ($theloai_The_thao == null &&
            $theloai_Van_phong == null &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where('nhanhieu', '=', $nhanhieu)
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })->paginate(24);
        }
//        s
        if ($size == 'null' &&
            $theloai_Van_phong == null &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where('nhanhieu', '=', $nhanhieu)
                ->where('theloai', '=', $theloai_The_thao)->paginate(24);
        }
//        s
        if ($size == 'null' &&
            $theloai_The_thao == null &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where('nhanhieu', '=', $nhanhieu)
                ->where('theloai', '=', $theloai_Van_phong)->paginate(24);
        }
//        s
        if ($size == 'null' &&
            $theloai_The_thao == null &&
            $theloai_Van_phong == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where('nhanhieu', '=', $nhanhieu)
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);
        }

//        s
        if ($nhanhieu == 'null' &&
            $theloai_Van_phong == null &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })
                ->where('theloai', '=', $theloai_The_thao)->paginate(24);
        }
//        s
        if ($nhanhieu == 'null' &&
            $theloai_The_thao == null &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })
                ->where('theloai', '=', $theloai_Van_phong)->paginate(24);
        }
//        s
        if ($nhanhieu == 'null' &&
            $theloai_The_thao == null &&
            $theloai_Van_phong == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);
        }

//        s
        if ($nhanhieu == 'null' &&
            $size == 'null' &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where('theloai', '=', $theloai_The_thao)
                ->where('theloai', '=', $theloai_Van_phong)->paginate(24);
        }
//        s
        if ($nhanhieu == 'null' &&
            $size == 'null' &&
            $theloai_Van_phong == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where('theloai', '=', $theloai_The_thao)
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);
        }

//        s
        if ($nhanhieu == 'null' &&
            $size == 'null' &&
            $theloai_The_thao == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where('theloai', '=', $theloai_Van_phong)
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);
        }

//        s
        if ($theloai_Van_phong == null &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where('nhanhieu', '=', $nhanhieu)
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })
                ->where('theloai', '=', $theloai_The_thao)->paginate(24);
        }
//        s
        if ($theloai_The_thao == null &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where('nhanhieu', '=', $nhanhieu)
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })
                ->where('theloai', '=', $theloai_Van_phong)->paginate(24);
        }
//        s
        if ($theloai_The_thao == null &&
            $theloai_Van_phong == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where('nhanhieu', '=', $nhanhieu)
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);
        }
//        s
        if ($size == 'null' &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where('nhanhieu', '=', $nhanhieu)
                ->where('theloai', '=', $theloai_The_thao)
                ->where('theloai', '=', $theloai_Van_phong)->paginate(24);
        }
//        s
        if ($size == 'null' &&
            $theloai_Van_phong == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where('nhanhieu', '=', $nhanhieu)
                ->where('theloai', '=', $theloai_The_thao)
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);
        }
//        s
        if ($size == 'null' &&
            $theloai_The_thao == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where('nhanhieu', '=', $nhanhieu)
                ->where('theloai', '=', $theloai_Van_phong)
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);
        }
//        s
        if ($nhanhieu == 'null' &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })
                ->where('theloai', '=', $theloai_The_thao)
                ->where('theloai', '=', $theloai_Van_phong)->paginate(24);
        }
//        s
        if ($nhanhieu == 'null' &&
            $theloai_Van_phong == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })
                ->where('theloai', '=', $theloai_The_thao)
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);
        }
//        s
        if ($nhanhieu == 'null' &&
            $theloai_The_thao == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })
                ->where('theloai', '=', $theloai_Van_phong)
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);
        }
//        s
        if ($nhanhieu == 'null' &&
            $size == 'null') {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where('theloai', '=', $theloai_The_thao)
                ->where('theloai', '=', $theloai_Van_phong)
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);
        }
//        s
        if ($nhanhieu == 'null') {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })
                ->where('theloai', '=', $theloai_The_thao)
                ->where('theloai', '=', $theloai_Van_phong)
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);

        }
//        s
        if ( $size == 'null') {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where('nhanhieu', '=', $nhanhieu)
                ->where('theloai', '=', $theloai_The_thao)
                ->where('theloai', '=', $theloai_Van_phong)
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);
        }
//        s
        if ($theloai_The_thao == null){
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where('nhanhieu', '=', $nhanhieu)
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })
                ->where('theloai', '=', $theloai_Van_phong)
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);

        }
//        s
        if ($theloai_Van_phong == null){
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where('nhanhieu', '=', $nhanhieu)
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })
                ->where('theloai', '=', $theloai_The_thao)
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);

        }
//        s
        if ( $theloai_Di_choi == null){
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where('nhanhieu', '=', $nhanhieu)
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })
                ->where('theloai', '=', $theloai_The_thao)
                ->where('theloai', '=', $theloai_Van_phong)->paginate(24);

        }
        return Product::where('money', '>=', $tien[0])
            ->where('money', '<=', $tien[1])
            ->where('menu_name1', '=', $nam)
            ->where('nhanhieu', '=', $nhanhieu)
            ->where(function ($query) use ($size) {
                return $query
                    ->where('size1', '=', $size)
                    ->orwhere('size2', '=', $size)
                    ->orwhere('size3', '=', $size)
                    ->orwhere('size4', '=', $size)
                    ->orwhere('size5', '=', $size)
                    ->orwhere('size6', '=', $size);
            })
            ->where('theloai', '=', $theloai_The_thao)
            ->where('theloai', '=', $theloai_Van_phong)
            ->where('theloai', '=', $theloai_Di_choi)->paginate(24);

    }

    public function getBLoc_nu($request)
    {
//        $theloai_Di_choi = null;
//        $theloai_The_thao = null;
//        $theloai_Van_phong = null;

        $money = $request->input('money');
        $tien = explode(";", $money);

        $theloai_Di_choi = $request->input('theloai_3');
        $theloai_The_thao = $request->input('theloai_1');
        $theloai_Van_phong = $request->input('theloai_2');

        $nhanhieu = $request->input('nhanhieu');
        $size = $request->input('size');
        $nam = 'Nữ';

//        s
        if ($nhanhieu == 'null' &&
            $size == 'null' &&
            $theloai_The_thao == null &&
            $theloai_Van_phong == null &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)->paginate(24);
        }


//        s
        if ($nhanhieu == 'null' &&
            $size == 'null' &&
            $theloai_The_thao == null &&
            $theloai_Van_phong == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);
        }
//        s
        if ($nhanhieu == 'null' &&
            $size == 'null' &&
            $theloai_The_thao == null &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where('theloai', '=', $theloai_Van_phong)->paginate(24);
        }
//        s
        if ($nhanhieu == 'null' &&
            $size == 'null' &&
            $theloai_Van_phong == null &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where('theloai', '=', $theloai_The_thao)->paginate(24);
        }
//        s
        if ($nhanhieu == 'null' &&
            $theloai_The_thao == null &&
            $theloai_Van_phong == null &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })->paginate(24);
        }
//        s
        if ($size == 'null' &&
            $theloai_The_thao == null &&
            $theloai_Van_phong == null &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where('nhanhieu', '=', $nhanhieu)->paginate(24);
        }

//        s
        if ($theloai_The_thao == null &&
            $theloai_Van_phong == null &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where('nhanhieu', '=', $nhanhieu)
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })->paginate(24);
        }
//        s
        if ($size == 'null' &&
            $theloai_Van_phong == null &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where('nhanhieu', '=', $nhanhieu)
                ->where('theloai', '=', $theloai_The_thao)->paginate(24);
        }
//        s
        if ($size == 'null' &&
            $theloai_The_thao == null &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where('nhanhieu', '=', $nhanhieu)
                ->where('theloai', '=', $theloai_Van_phong)->paginate(24);
        }
//        s
        if ($size == 'null' &&
            $theloai_The_thao == null &&
            $theloai_Van_phong == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where('nhanhieu', '=', $nhanhieu)
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);
        }

//        s
        if ($nhanhieu == 'null' &&
            $theloai_Van_phong == null &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })
                ->where('theloai', '=', $theloai_The_thao)->paginate(24);
        }
//        s
        if ($nhanhieu == 'null' &&
            $theloai_The_thao == null &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })
                ->where('theloai', '=', $theloai_Van_phong)->paginate(24);
        }
//        s
        if ($nhanhieu == 'null' &&
            $theloai_The_thao == null &&
            $theloai_Van_phong == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);
        }

//        s
        if ($nhanhieu == 'null' &&
            $size == 'null' &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where('theloai', '=', $theloai_The_thao)
                ->where('theloai', '=', $theloai_Van_phong)->paginate(24);
        }
//        s
        if ($nhanhieu == 'null' &&
            $size == 'null' &&
            $theloai_Van_phong == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where('theloai', '=', $theloai_The_thao)
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);
        }

//        s
        if ($nhanhieu == 'null' &&
            $size == 'null' &&
            $theloai_The_thao == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where('theloai', '=', $theloai_Van_phong)
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);
        }

//        s
        if ($theloai_Van_phong == null &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where('nhanhieu', '=', $nhanhieu)
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })
                ->where('theloai', '=', $theloai_The_thao)->paginate(24);
        }
//        s
        if ($theloai_The_thao == null &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where('nhanhieu', '=', $nhanhieu)
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })
                ->where('theloai', '=', $theloai_Van_phong)->paginate(24);
        }
//        s
        if ($theloai_The_thao == null &&
            $theloai_Van_phong == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where('nhanhieu', '=', $nhanhieu)
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);
        }
//        s
        if ($size == 'null' &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where('nhanhieu', '=', $nhanhieu)
                ->where('theloai', '=', $theloai_The_thao)
                ->where('theloai', '=', $theloai_Van_phong)->paginate(24);
        }
//        s
        if ($size == 'null' &&
            $theloai_Van_phong == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where('nhanhieu', '=', $nhanhieu)
                ->where('theloai', '=', $theloai_The_thao)
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);
        }
//        s
        if ($size == 'null' &&
            $theloai_The_thao == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where('nhanhieu', '=', $nhanhieu)
                ->where('theloai', '=', $theloai_Van_phong)
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);
        }
//        s
        if ($nhanhieu == 'null' &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })
                ->where('theloai', '=', $theloai_The_thao)
                ->where('theloai', '=', $theloai_Van_phong)->paginate(24);
        }
//        s
        if ($nhanhieu == 'null' &&
            $theloai_Van_phong == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })
                ->where('theloai', '=', $theloai_The_thao)
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);
        }
//        s
        if ($nhanhieu == 'null' &&
            $theloai_The_thao == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })
                ->where('theloai', '=', $theloai_Van_phong)
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);
        }
//        s
        if ($nhanhieu == 'null' &&
            $size == 'null') {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where('theloai', '=', $theloai_The_thao)
                ->where('theloai', '=', $theloai_Van_phong)
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);
        }
//        s
        if ($nhanhieu == 'null') {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })
                ->where('theloai', '=', $theloai_The_thao)
                ->where('theloai', '=', $theloai_Van_phong)
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);

        }
//        s
        if ( $size == 'null') {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where('nhanhieu', '=', $nhanhieu)
                ->where('theloai', '=', $theloai_The_thao)
                ->where('theloai', '=', $theloai_Van_phong)
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);
        }
//        s
        if ($theloai_The_thao == null){
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where('nhanhieu', '=', $nhanhieu)
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })
                ->where('theloai', '=', $theloai_Van_phong)
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);

        }
//        s
        if ($theloai_Van_phong == null){
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where('nhanhieu', '=', $nhanhieu)
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })
                ->where('theloai', '=', $theloai_The_thao)
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);

        }
//        s
        if ( $theloai_Di_choi == null){
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where('nhanhieu', '=', $nhanhieu)
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })
                ->where('theloai', '=', $theloai_The_thao)
                ->where('theloai', '=', $theloai_Van_phong)->paginate(24);

        }
        return Product::where('money', '>=', $tien[0])
            ->where('money', '<=', $tien[1])
            ->where('menu_name1', '=', $nam)
            ->where('nhanhieu', '=', $nhanhieu)
            ->where(function ($query) use ($size) {
                return $query
                    ->where('size1', '=', $size)
                    ->orwhere('size2', '=', $size)
                    ->orwhere('size3', '=', $size)
                    ->orwhere('size4', '=', $size)
                    ->orwhere('size5', '=', $size)
                    ->orwhere('size6', '=', $size);
            })
            ->where('theloai', '=', $theloai_The_thao)
            ->where('theloai', '=', $theloai_Van_phong)
            ->where('theloai', '=', $theloai_Di_choi)->paginate(24);

    }

    public function getBLoc_treem($request)
    {
//        $theloai_Di_choi = null;
//        $theloai_The_thao = null;
//        $theloai_Van_phong = null;

        $money = $request->input('money');
        $tien = explode(";", $money);

        $theloai_Di_choi = $request->input('theloai_3');
        $theloai_The_thao = $request->input('theloai_1');
        $theloai_Van_phong = $request->input('theloai_2');

        $nhanhieu = $request->input('nhanhieu');
        $size = $request->input('size');
//        $nam = 'Nữ';

//        s
        if ($nhanhieu == 'null' &&
            $size == 'null' &&
            $theloai_The_thao == null &&
            $theloai_Van_phong == null &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where(function ($query) {
                    return $query
                        ->where('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nữ')
                        ->orwhere('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nam')
                        ->orwhere('menu_name1', 'Trẻ em (3-6) _ trẻ Nữ')
                        ->orwhere('menu_name1', 'Trẻ em (3-6) _ trẻ Nam')
                        ->orwhere('menu_name1', 'Thanh thiếu niên (6-12) _ trẻ Nữ')
                        ->orwhere('menu_name1', 'Thanh thiếu niên (8-16) _ trẻ Nam');
                })->paginate(24);
        }


//        s
        if ($nhanhieu == 'null' &&
            $size == 'null' &&
            $theloai_The_thao == null &&
            $theloai_Van_phong == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where(function ($query) {
                    return $query
                        ->where('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nữ')
                        ->orwhere('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nam')
                        ->orwhere('menu_name1', 'Trẻ em (3-6) _ trẻ Nữ')
                        ->orwhere('menu_name1', 'Trẻ em (3-6) _ trẻ Nam')
                        ->orwhere('menu_name1', 'Thanh thiếu niên (6-12) _ trẻ Nữ')
                        ->orwhere('menu_name1', 'Thanh thiếu niên (8-16) _ trẻ Nam');
                })
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);
        }
//        s
        if ($nhanhieu == 'null' &&
            $size == 'null' &&
            $theloai_The_thao == null &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where(function ($query) {
                    return $query
                        ->where('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nữ')
                        ->orwhere('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nam')
                        ->orwhere('menu_name1', 'Trẻ em (3-6) _ trẻ Nữ')
                        ->orwhere('menu_name1', 'Trẻ em (3-6) _ trẻ Nam')
                        ->orwhere('menu_name1', 'Thanh thiếu niên (6-12) _ trẻ Nữ')
                        ->orwhere('menu_name1', 'Thanh thiếu niên (8-16) _ trẻ Nam');
                })
                ->where('theloai', '=', $theloai_Van_phong)->paginate(24);
        }
//        s
        if ($nhanhieu == 'null' &&
            $size == 'null' &&
            $theloai_Van_phong == null &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where(function ($query) {
                    return $query
                        ->where('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nữ')
                        ->orwhere('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nam')
                        ->orwhere('menu_name1', 'Trẻ em (3-6) _ trẻ Nữ')
                        ->orwhere('menu_name1', 'Trẻ em (3-6) _ trẻ Nam')
                        ->orwhere('menu_name1', 'Thanh thiếu niên (6-12) _ trẻ Nữ')
                        ->orwhere('menu_name1', 'Thanh thiếu niên (8-16) _ trẻ Nam');
                })
                ->where('theloai', '=', $theloai_The_thao)->paginate(24);
        }
//        s
        if ($nhanhieu == 'null' &&
            $theloai_The_thao == null &&
            $theloai_Van_phong == null &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where(function ($query) {
                    return $query
                        ->where('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nữ')
                        ->orwhere('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nam')
                        ->orwhere('menu_name1', 'Trẻ em (3-6) _ trẻ Nữ')
                        ->orwhere('menu_name1', 'Trẻ em (3-6) _ trẻ Nam')
                        ->orwhere('menu_name1', 'Thanh thiếu niên (6-12) _ trẻ Nữ')
                        ->orwhere('menu_name1', 'Thanh thiếu niên (8-16) _ trẻ Nam');
                })
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })->paginate(24);
        }
//        s
        if ($size == 'null' &&
            $theloai_The_thao == null &&
            $theloai_Van_phong == null &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where(function ($query) {
                    return $query
                        ->where('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nữ')
                        ->orwhere('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nam')
                        ->orwhere('menu_name1', 'Trẻ em (3-6) _ trẻ Nữ')
                        ->orwhere('menu_name1', 'Trẻ em (3-6) _ trẻ Nam')
                        ->orwhere('menu_name1', 'Thanh thiếu niên (6-12) _ trẻ Nữ')
                        ->orwhere('menu_name1', 'Thanh thiếu niên (8-16) _ trẻ Nam');
                })
                ->where('nhanhieu', '=', $nhanhieu)->paginate(24);
        }

//        s
        if ($theloai_The_thao == null &&
            $theloai_Van_phong == null &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where(function ($query) {
                    return $query
                        ->where('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nữ')
                        ->orwhere('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nam')
                        ->orwhere('menu_name1', 'Trẻ em (3-6) _ trẻ Nữ')
                        ->orwhere('menu_name1', 'Trẻ em (3-6) _ trẻ Nam')
                        ->orwhere('menu_name1', 'Thanh thiếu niên (6-12) _ trẻ Nữ')
                        ->orwhere('menu_name1', 'Thanh thiếu niên (8-16) _ trẻ Nam');
                })
                ->where('nhanhieu', '=', $nhanhieu)
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })->paginate(24);
        }
//        s
        if ($size == 'null' &&
            $theloai_Van_phong == null &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where(function ($query) {
                    return $query
                        ->where('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nữ')
                        ->orwhere('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nam')
                        ->orwhere('menu_name1', 'Trẻ em (3-6) _ trẻ Nữ')
                        ->orwhere('menu_name1', 'Trẻ em (3-6) _ trẻ Nam')
                        ->orwhere('menu_name1', 'Thanh thiếu niên (6-12) _ trẻ Nữ')
                        ->orwhere('menu_name1', 'Thanh thiếu niên (8-16) _ trẻ Nam');
                })
                ->where('nhanhieu', '=', $nhanhieu)
                ->where('theloai', '=', $theloai_The_thao)->paginate(24);
        }
//        s
        if ($size == 'null' &&
            $theloai_The_thao == null &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where(function ($query) {
                    return $query
                        ->where('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nữ')
                        ->orwhere('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nam')
                        ->orwhere('menu_name1', 'Trẻ em (3-6) _ trẻ Nữ')
                        ->orwhere('menu_name1', 'Trẻ em (3-6) _ trẻ Nam')
                        ->orwhere('menu_name1', 'Thanh thiếu niên (6-12) _ trẻ Nữ')
                        ->orwhere('menu_name1', 'Thanh thiếu niên (8-16) _ trẻ Nam');
                })
                ->where('nhanhieu', '=', $nhanhieu)
                ->where('theloai', '=', $theloai_Van_phong)->paginate(24);
        }
//        s
        if ($size == 'null' &&
            $theloai_The_thao == null &&
            $theloai_Van_phong == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where(function ($query) {
                    return $query
                        ->where('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nữ')
                        ->orwhere('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nam')
                        ->orwhere('menu_name1', 'Trẻ em (3-6) _ trẻ Nữ')
                        ->orwhere('menu_name1', 'Trẻ em (3-6) _ trẻ Nam')
                        ->orwhere('menu_name1', 'Thanh thiếu niên (6-12) _ trẻ Nữ')
                        ->orwhere('menu_name1', 'Thanh thiếu niên (8-16) _ trẻ Nam');
                })
                ->where('nhanhieu', '=', $nhanhieu)
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);
        }

//        s
        if ($nhanhieu == 'null' &&
            $theloai_Van_phong == null &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where(function ($query) {
                    return $query
                        ->where('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nữ')
                        ->orwhere('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nam')
                        ->orwhere('menu_name1', 'Trẻ em (3-6) _ trẻ Nữ')
                        ->orwhere('menu_name1', 'Trẻ em (3-6) _ trẻ Nam')
                        ->orwhere('menu_name1', 'Thanh thiếu niên (6-12) _ trẻ Nữ')
                        ->orwhere('menu_name1', 'Thanh thiếu niên (8-16) _ trẻ Nam');
                })
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })
                ->where('theloai', '=', $theloai_The_thao)->paginate(24);
        }
//        s
        if ($nhanhieu == 'null' &&
            $theloai_The_thao == null &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where(function ($query) {
                    return $query
                        ->where('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nữ')
                        ->orwhere('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nam')
                        ->orwhere('menu_name1', 'Trẻ em (3-6) _ trẻ Nữ')
                        ->orwhere('menu_name1', 'Trẻ em (3-6) _ trẻ Nam')
                        ->orwhere('menu_name1', 'Thanh thiếu niên (6-12) _ trẻ Nữ')
                        ->orwhere('menu_name1', 'Thanh thiếu niên (8-16) _ trẻ Nam');
                })
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })
                ->where('theloai', '=', $theloai_Van_phong)->paginate(24);
        }
//        s
        if ($nhanhieu == 'null' &&
            $theloai_The_thao == null &&
            $theloai_Van_phong == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where(function ($query) {
                    return $query
                        ->where('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nữ')
                        ->orwhere('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nam')
                        ->orwhere('menu_name1', 'Trẻ em (3-6) _ trẻ Nữ')
                        ->orwhere('menu_name1', 'Trẻ em (3-6) _ trẻ Nam')
                        ->orwhere('menu_name1', 'Thanh thiếu niên (6-12) _ trẻ Nữ')
                        ->orwhere('menu_name1', 'Thanh thiếu niên (8-16) _ trẻ Nam');
                })                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);
        }

//        s
        if ($nhanhieu == 'null' &&
            $size == 'null' &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where(function ($query) {
                    return $query
                        ->where('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nữ')
                        ->orwhere('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nam')
                        ->orwhere('menu_name1', 'Trẻ em (3-6) _ trẻ Nữ')
                        ->orwhere('menu_name1', 'Trẻ em (3-6) _ trẻ Nam')
                        ->orwhere('menu_name1', 'Thanh thiếu niên (6-12) _ trẻ Nữ')
                        ->orwhere('menu_name1', 'Thanh thiếu niên (8-16) _ trẻ Nam');
                })                ->where('theloai', '=', $theloai_The_thao)
                ->where('theloai', '=', $theloai_Van_phong)->paginate(24);
        }
//        s
        if ($nhanhieu == 'null' &&
            $size == 'null' &&
            $theloai_Van_phong == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where(function ($query) {
                    return $query
                        ->where('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nữ')
                        ->orwhere('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nam')
                        ->orwhere('menu_name1', 'Trẻ em (3-6) _ trẻ Nữ')
                        ->orwhere('menu_name1', 'Trẻ em (3-6) _ trẻ Nam')
                        ->orwhere('menu_name1', 'Thanh thiếu niên (6-12) _ trẻ Nữ')
                        ->orwhere('menu_name1', 'Thanh thiếu niên (8-16) _ trẻ Nam');
                })                ->where('theloai', '=', $theloai_The_thao)
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);
        }

//        s
        if ($nhanhieu == 'null' &&
            $size == 'null' &&
            $theloai_The_thao == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where(function ($query) {
                    return $query
                        ->where('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nữ')
                        ->orwhere('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nam')
                        ->orwhere('menu_name1', 'Trẻ em (3-6) _ trẻ Nữ')
                        ->orwhere('menu_name1', 'Trẻ em (3-6) _ trẻ Nam')
                        ->orwhere('menu_name1', 'Thanh thiếu niên (6-12) _ trẻ Nữ')
                        ->orwhere('menu_name1', 'Thanh thiếu niên (8-16) _ trẻ Nam');
                })                ->where('theloai', '=', $theloai_Van_phong)
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);
        }

//        s
        if ($theloai_Van_phong == null &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where(function ($query) {
                    return $query
                        ->where('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nữ')
                        ->orwhere('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nam')
                        ->orwhere('menu_name1', 'Trẻ em (3-6) _ trẻ Nữ')
                        ->orwhere('menu_name1', 'Trẻ em (3-6) _ trẻ Nam')
                        ->orwhere('menu_name1', 'Thanh thiếu niên (6-12) _ trẻ Nữ')
                        ->orwhere('menu_name1', 'Thanh thiếu niên (8-16) _ trẻ Nam');
                })                ->where('nhanhieu', '=', $nhanhieu)
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })
                ->where('theloai', '=', $theloai_The_thao)->paginate(24);
        }
//        s
        if ($theloai_The_thao == null &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where(function ($query) {
                    return $query
                        ->where('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nữ')
                        ->orwhere('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nam')
                        ->orwhere('menu_name1', 'Trẻ em (3-6) _ trẻ Nữ')
                        ->orwhere('menu_name1', 'Trẻ em (3-6) _ trẻ Nam')
                        ->orwhere('menu_name1', 'Thanh thiếu niên (6-12) _ trẻ Nữ')
                        ->orwhere('menu_name1', 'Thanh thiếu niên (8-16) _ trẻ Nam');
                })                ->where('nhanhieu', '=', $nhanhieu)
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })
                ->where('theloai', '=', $theloai_Van_phong)->paginate(24);
        }
//        s
        if ($theloai_The_thao == null &&
            $theloai_Van_phong == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where(function ($query) {
                    return $query
                        ->where('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nữ')
                        ->orwhere('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nam')
                        ->orwhere('menu_name1', 'Trẻ em (3-6) _ trẻ Nữ')
                        ->orwhere('menu_name1', 'Trẻ em (3-6) _ trẻ Nam')
                        ->orwhere('menu_name1', 'Thanh thiếu niên (6-12) _ trẻ Nữ')
                        ->orwhere('menu_name1', 'Thanh thiếu niên (8-16) _ trẻ Nam');
                })                ->where('nhanhieu', '=', $nhanhieu)
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);
        }
//        s
        if ($size == 'null' &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where(function ($query) {
                    return $query
                        ->where('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nữ')
                        ->orwhere('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nam')
                        ->orwhere('menu_name1', 'Trẻ em (3-6) _ trẻ Nữ')
                        ->orwhere('menu_name1', 'Trẻ em (3-6) _ trẻ Nam')
                        ->orwhere('menu_name1', 'Thanh thiếu niên (6-12) _ trẻ Nữ')
                        ->orwhere('menu_name1', 'Thanh thiếu niên (8-16) _ trẻ Nam');
                })                ->where('nhanhieu', '=', $nhanhieu)
                ->where('theloai', '=', $theloai_The_thao)
                ->where('theloai', '=', $theloai_Van_phong)->paginate(24);
        }
//        s
        if ($size == 'null' &&
            $theloai_Van_phong == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where(function ($query) {
                    return $query
                        ->where('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nữ')
                        ->orwhere('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nam')
                        ->orwhere('menu_name1', 'Trẻ em (3-6) _ trẻ Nữ')
                        ->orwhere('menu_name1', 'Trẻ em (3-6) _ trẻ Nam')
                        ->orwhere('menu_name1', 'Thanh thiếu niên (6-12) _ trẻ Nữ')
                        ->orwhere('menu_name1', 'Thanh thiếu niên (8-16) _ trẻ Nam');
                })                ->where('nhanhieu', '=', $nhanhieu)
                ->where('theloai', '=', $theloai_The_thao)
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);
        }
//        s
        if ($size == 'null' &&
            $theloai_The_thao == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where(function ($query) {
                    return $query
                        ->where('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nữ')
                        ->orwhere('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nam')
                        ->orwhere('menu_name1', 'Trẻ em (3-6) _ trẻ Nữ')
                        ->orwhere('menu_name1', 'Trẻ em (3-6) _ trẻ Nam')
                        ->orwhere('menu_name1', 'Thanh thiếu niên (6-12) _ trẻ Nữ')
                        ->orwhere('menu_name1', 'Thanh thiếu niên (8-16) _ trẻ Nam');
                })                ->where('nhanhieu', '=', $nhanhieu)
                ->where('theloai', '=', $theloai_Van_phong)
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);
        }
//        s
        if ($nhanhieu == 'null' &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where(function ($query) {
                    return $query
                        ->where('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nữ')
                        ->orwhere('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nam')
                        ->orwhere('menu_name1', 'Trẻ em (3-6) _ trẻ Nữ')
                        ->orwhere('menu_name1', 'Trẻ em (3-6) _ trẻ Nam')
                        ->orwhere('menu_name1', 'Thanh thiếu niên (6-12) _ trẻ Nữ')
                        ->orwhere('menu_name1', 'Thanh thiếu niên (8-16) _ trẻ Nam');
                })                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })
                ->where('theloai', '=', $theloai_The_thao)
                ->where('theloai', '=', $theloai_Van_phong)->paginate(24);
        }
//        s
        if ($nhanhieu == 'null' &&
            $theloai_Van_phong == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where(function ($query) {
                    return $query
                        ->where('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nữ')
                        ->orwhere('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nam')
                        ->orwhere('menu_name1', 'Trẻ em (3-6) _ trẻ Nữ')
                        ->orwhere('menu_name1', 'Trẻ em (3-6) _ trẻ Nam')
                        ->orwhere('menu_name1', 'Thanh thiếu niên (6-12) _ trẻ Nữ')
                        ->orwhere('menu_name1', 'Thanh thiếu niên (8-16) _ trẻ Nam');
                })                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })
                ->where('theloai', '=', $theloai_The_thao)
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);
        }
//        s
        if ($nhanhieu == 'null' &&
            $theloai_The_thao == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where(function ($query) {
                    return $query
                        ->where('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nữ')
                        ->orwhere('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nam')
                        ->orwhere('menu_name1', 'Trẻ em (3-6) _ trẻ Nữ')
                        ->orwhere('menu_name1', 'Trẻ em (3-6) _ trẻ Nam')
                        ->orwhere('menu_name1', 'Thanh thiếu niên (6-12) _ trẻ Nữ')
                        ->orwhere('menu_name1', 'Thanh thiếu niên (8-16) _ trẻ Nam');
                })                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })
                ->where('theloai', '=', $theloai_Van_phong)
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);
        }
//        s
        if ($nhanhieu == 'null' &&
            $size == 'null') {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where(function ($query) {
                    return $query
                        ->where('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nữ')
                        ->orwhere('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nam')
                        ->orwhere('menu_name1', 'Trẻ em (3-6) _ trẻ Nữ')
                        ->orwhere('menu_name1', 'Trẻ em (3-6) _ trẻ Nam')
                        ->orwhere('menu_name1', 'Thanh thiếu niên (6-12) _ trẻ Nữ')
                        ->orwhere('menu_name1', 'Thanh thiếu niên (8-16) _ trẻ Nam');
                })                ->where('theloai', '=', $theloai_The_thao)
                ->where('theloai', '=', $theloai_Van_phong)
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);
        }
//        s
        if ($nhanhieu == 'null') {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where(function ($query) {
                    return $query
                        ->where('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nữ')
                        ->orwhere('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nam')
                        ->orwhere('menu_name1', 'Trẻ em (3-6) _ trẻ Nữ')
                        ->orwhere('menu_name1', 'Trẻ em (3-6) _ trẻ Nam')
                        ->orwhere('menu_name1', 'Thanh thiếu niên (6-12) _ trẻ Nữ')
                        ->orwhere('menu_name1', 'Thanh thiếu niên (8-16) _ trẻ Nam');
                })                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })
                ->where('theloai', '=', $theloai_The_thao)
                ->where('theloai', '=', $theloai_Van_phong)
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);

        }
//        s
        if ( $size == 'null') {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where(function ($query) {
                    return $query
                        ->where('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nữ')
                        ->orwhere('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nam')
                        ->orwhere('menu_name1', 'Trẻ em (3-6) _ trẻ Nữ')
                        ->orwhere('menu_name1', 'Trẻ em (3-6) _ trẻ Nam')
                        ->orwhere('menu_name1', 'Thanh thiếu niên (6-12) _ trẻ Nữ')
                        ->orwhere('menu_name1', 'Thanh thiếu niên (8-16) _ trẻ Nam');
                })                ->where('nhanhieu', '=', $nhanhieu)
                ->where('theloai', '=', $theloai_The_thao)
                ->where('theloai', '=', $theloai_Van_phong)
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);
        }
//        s
        if ($theloai_The_thao == null){
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where(function ($query) {
                    return $query
                        ->where('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nữ')
                        ->orwhere('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nam')
                        ->orwhere('menu_name1', 'Trẻ em (3-6) _ trẻ Nữ')
                        ->orwhere('menu_name1', 'Trẻ em (3-6) _ trẻ Nam')
                        ->orwhere('menu_name1', 'Thanh thiếu niên (6-12) _ trẻ Nữ')
                        ->orwhere('menu_name1', 'Thanh thiếu niên (8-16) _ trẻ Nam');
                })                ->where('nhanhieu', '=', $nhanhieu)
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })
                ->where('theloai', '=', $theloai_Van_phong)
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);

        }
//        s
        if ($theloai_Van_phong == null){
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where(function ($query) {
                    return $query
                        ->where('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nữ')
                        ->orwhere('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nam')
                        ->orwhere('menu_name1', 'Trẻ em (3-6) _ trẻ Nữ')
                        ->orwhere('menu_name1', 'Trẻ em (3-6) _ trẻ Nam')
                        ->orwhere('menu_name1', 'Thanh thiếu niên (6-12) _ trẻ Nữ')
                        ->orwhere('menu_name1', 'Thanh thiếu niên (8-16) _ trẻ Nam');
                })                ->where('nhanhieu', '=', $nhanhieu)
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })
                ->where('theloai', '=', $theloai_The_thao)
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);

        }
//        s
        if ( $theloai_Di_choi == null){
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where(function ($query) {
                    return $query
                        ->where('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nữ')
                        ->orwhere('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nam')
                        ->orwhere('menu_name1', 'Trẻ em (3-6) _ trẻ Nữ')
                        ->orwhere('menu_name1', 'Trẻ em (3-6) _ trẻ Nam')
                        ->orwhere('menu_name1', 'Thanh thiếu niên (6-12) _ trẻ Nữ')
                        ->orwhere('menu_name1', 'Thanh thiếu niên (8-16) _ trẻ Nam');
                })                ->where('nhanhieu', '=', $nhanhieu)
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })
                ->where('theloai', '=', $theloai_The_thao)
                ->where('theloai', '=', $theloai_Van_phong)->paginate(24);

        }
        return Product::where('money', '>=', $tien[0])
            ->where('money', '<=', $tien[1])
            ->where(function ($query) {
                return $query
                    ->where('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nữ')
                    ->orwhere('menu_name1', 'Trẻ nhỏ & trẻ mới biết đi (1-3) _ tre Nam')
                    ->orwhere('menu_name1', 'Trẻ em (3-6) _ trẻ Nữ')
                    ->orwhere('menu_name1', 'Trẻ em (3-6) _ trẻ Nam')
                    ->orwhere('menu_name1', 'Thanh thiếu niên (6-12) _ trẻ Nữ')
                    ->orwhere('menu_name1', 'Thanh thiếu niên (8-16) _ trẻ Nam');
            })            ->where('nhanhieu', '=', $nhanhieu)
            ->where(function ($query) use ($size) {
                return $query
                    ->where('size1', '=', $size)
                    ->orwhere('size2', '=', $size)
                    ->orwhere('size3', '=', $size)
                    ->orwhere('size4', '=', $size)
                    ->orwhere('size5', '=', $size)
                    ->orwhere('size6', '=', $size);
            })
            ->where('theloai', '=', $theloai_The_thao)
            ->where('theloai', '=', $theloai_Van_phong)
            ->where('theloai', '=', $theloai_Di_choi)->paginate(24);

    }

    public function getBLocTreEm1_12($request, $menu_name1)
    {
//        $theloai_Di_choi = null;
//        $theloai_The_thao = null;
//        $theloai_Van_phong = null;

        $money = $request->input('money');
        $tien = explode(";", $money);

        $theloai_Di_choi = $request->input('theloai_3');
        $theloai_The_thao = $request->input('theloai_1');
        $theloai_Van_phong = $request->input('theloai_2');

        $nhanhieu = $request->input('nhanhieu');
        $size = $request->input('size');
        $nam = $menu_name1;

//        s
        if ($nhanhieu == 'null' &&
            $size == 'null' &&
            $theloai_The_thao == null &&
            $theloai_Van_phong == null &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)->paginate(24);
        }


//        s
        if ($nhanhieu == 'null' &&
            $size == 'null' &&
            $theloai_The_thao == null &&
            $theloai_Van_phong == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);
        }
//        s
        if ($nhanhieu == 'null' &&
            $size == 'null' &&
            $theloai_The_thao == null &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where('theloai', '=', $theloai_Van_phong)->paginate(24);
        }
//        s
        if ($nhanhieu == 'null' &&
            $size == 'null' &&
            $theloai_Van_phong == null &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where('theloai', '=', $theloai_The_thao)->paginate(24);
        }
//        s
        if ($nhanhieu == 'null' &&
            $theloai_The_thao == null &&
            $theloai_Van_phong == null &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })->paginate(24);
        }
//        s
        if ($size == 'null' &&
            $theloai_The_thao == null &&
            $theloai_Van_phong == null &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where('nhanhieu', '=', $nhanhieu)->paginate(24);
        }

//        s
        if ($theloai_The_thao == null &&
            $theloai_Van_phong == null &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where('nhanhieu', '=', $nhanhieu)
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })->paginate(24);
        }
//        s
        if ($size == 'null' &&
            $theloai_Van_phong == null &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where('nhanhieu', '=', $nhanhieu)
                ->where('theloai', '=', $theloai_The_thao)->paginate(24);
        }
//        s
        if ($size == 'null' &&
            $theloai_The_thao == null &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where('nhanhieu', '=', $nhanhieu)
                ->where('theloai', '=', $theloai_Van_phong)->paginate(24);
        }
//        s
        if ($size == 'null' &&
            $theloai_The_thao == null &&
            $theloai_Van_phong == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where('nhanhieu', '=', $nhanhieu)
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);
        }

//        s
        if ($nhanhieu == 'null' &&
            $theloai_Van_phong == null &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })
                ->where('theloai', '=', $theloai_The_thao)->paginate(24);
        }
//        s
        if ($nhanhieu == 'null' &&
            $theloai_The_thao == null &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })
                ->where('theloai', '=', $theloai_Van_phong)->paginate(24);
        }
//        s
        if ($nhanhieu == 'null' &&
            $theloai_The_thao == null &&
            $theloai_Van_phong == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);
        }

//        s
        if ($nhanhieu == 'null' &&
            $size == 'null' &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where('theloai', '=', $theloai_The_thao)
                ->where('theloai', '=', $theloai_Van_phong)->paginate(24);
        }
//        s
        if ($nhanhieu == 'null' &&
            $size == 'null' &&
            $theloai_Van_phong == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where('theloai', '=', $theloai_The_thao)
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);
        }

//        s
        if ($nhanhieu == 'null' &&
            $size == 'null' &&
            $theloai_The_thao == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where('theloai', '=', $theloai_Van_phong)
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);
        }

//        s
        if ($theloai_Van_phong == null &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where('nhanhieu', '=', $nhanhieu)
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })
                ->where('theloai', '=', $theloai_The_thao)->paginate(24);
        }
//        s
        if ($theloai_The_thao == null &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where('nhanhieu', '=', $nhanhieu)
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })
                ->where('theloai', '=', $theloai_Van_phong)->paginate(24);
        }
//        s
        if ($theloai_The_thao == null &&
            $theloai_Van_phong == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where('nhanhieu', '=', $nhanhieu)
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);
        }
//        s
        if ($size == 'null' &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where('nhanhieu', '=', $nhanhieu)
                ->where('theloai', '=', $theloai_The_thao)
                ->where('theloai', '=', $theloai_Van_phong)->paginate(24);
        }
//        s
        if ($size == 'null' &&
            $theloai_Van_phong == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where('nhanhieu', '=', $nhanhieu)
                ->where('theloai', '=', $theloai_The_thao)
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);
        }
//        s
        if ($size == 'null' &&
            $theloai_The_thao == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where('nhanhieu', '=', $nhanhieu)
                ->where('theloai', '=', $theloai_Van_phong)
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);
        }
//        s
        if ($nhanhieu == 'null' &&
            $theloai_Di_choi == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })
                ->where('theloai', '=', $theloai_The_thao)
                ->where('theloai', '=', $theloai_Van_phong)->paginate(24);
        }
//        s
        if ($nhanhieu == 'null' &&
            $theloai_Van_phong == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })
                ->where('theloai', '=', $theloai_The_thao)
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);
        }
//        s
        if ($nhanhieu == 'null' &&
            $theloai_The_thao == null) {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })
                ->where('theloai', '=', $theloai_Van_phong)
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);
        }
//        s
        if ($nhanhieu == 'null' &&
            $size == 'null') {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where('theloai', '=', $theloai_The_thao)
                ->where('theloai', '=', $theloai_Van_phong)
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);
        }
//        s
        if ($nhanhieu == 'null') {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })
                ->where('theloai', '=', $theloai_The_thao)
                ->where('theloai', '=', $theloai_Van_phong)
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);

        }
//        s
        if ( $size == 'null') {
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where('nhanhieu', '=', $nhanhieu)
                ->where('theloai', '=', $theloai_The_thao)
                ->where('theloai', '=', $theloai_Van_phong)
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);
        }
//        s
        if ($theloai_The_thao == null){
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where('nhanhieu', '=', $nhanhieu)
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })
                ->where('theloai', '=', $theloai_Van_phong)
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);

        }
//        s
        if ($theloai_Van_phong == null){
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where('nhanhieu', '=', $nhanhieu)
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })
                ->where('theloai', '=', $theloai_The_thao)
                ->where('theloai', '=', $theloai_Di_choi)->paginate(24);

        }
//        s
        if ( $theloai_Di_choi == null){
            return Product::where('money', '>=', $tien[0])
                ->where('money', '<=', $tien[1])
                ->where('menu_name1', '=', $nam)
                ->where('nhanhieu', '=', $nhanhieu)
                ->where(function ($query) use ($size) {
                    return $query
                        ->where('size1', '=', $size)
                        ->orwhere('size2', '=', $size)
                        ->orwhere('size3', '=', $size)
                        ->orwhere('size4', '=', $size)
                        ->orwhere('size5', '=', $size)
                        ->orwhere('size6', '=', $size);
                })
                ->where('theloai', '=', $theloai_The_thao)
                ->where('theloai', '=', $theloai_Van_phong)->paginate(24);

        }
        return Product::where('money', '>=', $tien[0])
            ->where('money', '<=', $tien[1])
            ->where('menu_name1', '=', $nam)
            ->where('nhanhieu', '=', $nhanhieu)
            ->where(function ($query) use ($size) {
                return $query
                    ->where('size1', '=', $size)
                    ->orwhere('size2', '=', $size)
                    ->orwhere('size3', '=', $size)
                    ->orwhere('size4', '=', $size)
                    ->orwhere('size5', '=', $size)
                    ->orwhere('size6', '=', $size);
            })
            ->where('theloai', '=', $theloai_The_thao)
            ->where('theloai', '=', $theloai_Van_phong)
            ->where('theloai', '=', $theloai_Di_choi)->paginate(24);

    }

    public function getCLoai($loai){
        return Product::where('name', '=', $loai)->get();
    }

    public function SPTT($size1, $size2, $size3, $size4, $size5, $size6, $loai){
        return Product::where(function ($query) use ($size1, $size2, $size3, $size4, $size5, $size6, $loai) {
            return $query
                ->where('size1', '=', $size1)
                ->orwhere('size2', '=', $size1)
                ->orwhere('size3', '=', $size1)
                ->orwhere('size4', '=', $size1)
                ->orwhere('size5', '=', $size1)
                ->orwhere('size6', '=', $size1)

                ->orwhere('size1', '=', $size2)
                ->orwhere('size2', '=', $size2)
                ->orwhere('size3', '=', $size2)
                ->orwhere('size4', '=', $size2)
                ->orwhere('size5', '=', $size2)
                ->orwhere('size6', '=', $size2)

                ->orwhere('size1', '=', $size3)
                ->orwhere('size2', '=', $size3)
                ->orwhere('size3', '=', $size3)
                ->orwhere('size4', '=', $size3)
                ->orwhere('size5', '=', $size3)
                ->orwhere('size6', '=', $size3)

                ->orwhere('size1', '=', $size4)
                ->orwhere('size2', '=', $size4)
                ->orwhere('size3', '=', $size4)
                ->orwhere('size4', '=', $size4)
                ->orwhere('size5', '=', $size4)
                ->orwhere('size6', '=', $size4)

                ->orwhere('size1', '=', $size5)
                ->orwhere('size2', '=', $size5)
                ->orwhere('size3', '=', $size5)
                ->orwhere('size4', '=', $size5)
                ->orwhere('size5', '=', $size5)
                ->orwhere('size6', '=', $size5)

                ->orwhere('size1', '=', $size6)
                ->orwhere('size2', '=', $size6)
                ->orwhere('size3', '=', $size6)
                ->orwhere('size4', '=', $size6)
                ->orwhere('size5', '=', $size6)
                ->orwhere('size6', '=', $size6);
            })
            ->where('theloai', '=', $loai)->paginate(6);
    }

    public function getyeuthich($idKH, $idSP){
        return Yeuthich::where('ID_KH', '=', $idKH)
            ->where('ID_SP','=', $idSP)->first();
    }
}
