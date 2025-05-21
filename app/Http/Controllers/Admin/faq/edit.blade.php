<select name="faq_category_id">
  @foreach($categories as $cat)
    <option value="{{ $cat->id }}" {{ isset($faq) && $faq->faq_category_id == $cat->id ? 'selected' : '' }}>
      {{ $cat->name }}
    </option>
  @endforeach
</select>

<input name="question" value="{{ old('question', $faq->question ?? '') }}" />
<textarea name="answer">{{ old('answer', $faq->answer ?? '') }}</textarea>