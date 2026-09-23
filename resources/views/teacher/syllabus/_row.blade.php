<div
    data-row
    class="space-y-4 rounded-xl border border-purple-100 bg-purple-50/30 p-4"
>
    @if ($group === 'schedule')
        <div class="grid gap-4 sm:grid-cols-2">
            <x-teacher-field
                :name="'schedule.'.$index.'.week'"
                label="Week"
                type="number"
                :value="$row['week'] ?? ''"
                min="1"
                required
                data-week
            />
            <x-teacher-field
                :name="'schedule.'.$index.'.dates'"
                label="Dates"
                :value="$row['dates'] ?? ''"
                placeholder="e.g. Aug 20–21"
                maxlength="100"
            />
        </div>
        <x-teacher-field
            :name="'schedule.'.$index.'.topic'"
            label="Topic"
            :value="$row['topic'] ?? ''"
            maxlength="500"
            required
        />
        <x-teacher-field
            :name="'schedule.'.$index.'.tags'"
            label="Activity labels"
            :value="$row['tags'] ?? ''"
            help="Separate labels with commas."
            maxlength="255"
        />
        <x-teacher-field
            :name="'schedule.'.$index.'.homework'"
            label="Homework or notes"
            type="textarea"
            :value="$row['homework'] ?? ''"
            rows="2"
            maxlength="2000"
        />
    @elseif ($group === 'assessments')
        <div class="grid gap-4 sm:grid-cols-3">
            <div class="sm:col-span-2">
                <x-teacher-field
                    :name="'assessments.'.$index.'.label'"
                    label="Assessment"
                    :value="$row['label'] ?? ''"
                    maxlength="255"
                    required
                />
            </div>
            <x-teacher-field
                :name="'assessments.'.$index.'.weight'"
                label="Weight (%)"
                type="number"
                :value="$row['weight'] ?? ''"
                min="0"
                max="100"
                step="0.01"
                required
                data-weight
            />
        </div>
    @else
        <div class="grid gap-4 sm:grid-cols-2">
            <x-teacher-field
                :name="'grading.'.$index.'.range'"
                label="Score range"
                :value="$row['range'] ?? ''"
                maxlength="100"
                required
            />
            <x-teacher-field
                :name="'grading.'.$index.'.grade'"
                label="Grade"
                :value="$row['grade'] ?? ''"
                maxlength="20"
                required
            />
        </div>
    @endif
    <button
        type="button"
        data-remove-row
        class="text-xs font-semibold text-red-700 underline-offset-4 hover:underline"
    >
        Remove {{ $group === 'schedule' ? 'week' : 'row' }}
    </button>
</div>
