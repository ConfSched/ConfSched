@extends('template')

@section('title')
ConfSched | Committee Sourcing
@endsection

@section('navigation')
@include('navigation')
@endsection

@section('content')
<style>
  .panel-heading span {
    margin-top: -26px;
    font-size: 15px;
    margin-right: -12px;
  }

  .clickable {
    background: rgba(0, 0, 0, 0.15);
    display: inline-block;
    padding: 6px 12px;
    border-radius: 4px;
    /*cursor: pointer;*/
  }
</style>

<script>
  $(function() {
   $('#topic_filter').on('change', function() {
    $(this).parents('form:first').submit();
  });
 });

  $(function(){
   $('[data-method]').append(function(){
        return "\n"+
        "<form action='"+$(this).attr('href')+"' method='POST' style='display:none'>\n"+
        "   <input type='hidden' name='_method' value='"+$(this).attr('data-method')+"'>\n"+
        "</form>\n"
   })
   .removeAttr('href')
   .attr('style','cursor:pointer;')
   .attr('onclick','$(this).find("form").submit();');
});
</script>

<h1>Committee Sourcing</h1>
<hr>

<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
   <form method="GET">
    <select name="topicid" id="topic_filter" class="form-control">
     @foreach($topics as $current)
     @if(Input::get('topicid', '') == $current->topicid)
     <option value="{{$current->topicid}}" selected="selected">{{$current->topicname}}</option>
     @else
     <option value="{{$current->topicid}}">{{$current->topicname}}</option>
     @endif
     @endforeach
   </select>
 </form>
</div>
<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
 <a href="{{ action('CommitteeSourcingController@getCreateCategory', array('id' => $topic->topicid)) }}" class="btn btn-primary btn-lg visible-md visible-lg pull-right">Add new category</a>
 <a href="{{ action('CommitteeSourcingController@getCreateCategory', array('id' => $topic->topicid)) }}" class="btn btn-primary btn-lg btn-block hidden-md hidden-lg" style="margin-top: 10px;">Add new category</a>
</div>
</div>

<br>

<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
   <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">Papers</h3>
    </div>
    <div class="panel-body">
      <div class="list-group">
        @foreach($papers as $paper)
          <a href="{{ action('CommitteeSourcingController@getPaper', array('id' => $paper->paperid)) }}" class="list-group-item" data-method="DELETE">{{ $paper->title }}</a>
        @endforeach
      </div>
    </div>
  </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
 <?php $count = 0; ?>
 @foreach($categories as $category)
 @if ($count % 2 == 0)
 <div class="row">
  @endif
  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
   <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">{{ $category->name }}</h3>
      <a href="{{ action('CommitteeSourcingController@deleteCategory', array('id' => $category->id)) }}"><span class="pull-right clickable"><i class="fa fa-times"></i></span></a>
    </div>
    <div class="panel-body">
      <div class="list-group">
        @foreach($category->papers as $paper)
        <div class="list-group-item">{{ $paper->title }} <a href="{{ action('CommitteeSourcingController@deleteCategoryPaperMap', array('paperid' => $paper->paperid, 'categoryid' => $category->id)) }}" data-method="DELETE"><span class="pull-right"><i class="fa fa-times"></i></span></a></div>
        @endforeach
      </div>
    </div>
  </div>
</div>
@if ($count % 2 != 0)
</div>
@endif
<?php $count ++; ?>
@endforeach
</div>
</div>
@endsection
