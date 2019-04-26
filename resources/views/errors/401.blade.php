@extends('errors::minimal')

@section('title', __('Nedostatečné oprávnění'))
@section('code', '401')
@section('message', __('Nemáte dostatečné oprávnění pro přístup na tuto stránku'))
