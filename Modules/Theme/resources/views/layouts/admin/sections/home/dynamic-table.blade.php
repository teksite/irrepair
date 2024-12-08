@props(['open'=>true])
@php

        if (isset($instance) && $instance->meta()->where('key','table')->first()?->value ){
            $table=$instance->meta()->where('key','table')->first()?->value;

            $headings = $table['titles'] ? "'".implode("','",$table['titles'])."'" : '';
            $items = $table['options'] ?? [];
        }
        elseif(old('plans') !== null){
            $old=old('plans');
            $headings="'".implode("','",$old['titles'])."'" ;
            $items=$old['options'] ?? [];

        } else{
            $headings="'ستون اول','ستون دوم', 'ستون سوم'";
            $items=[];
        }
@endphp

@push('footerScripts')
    <script>
        window.AlpineComponents = {}

        window.AlpineComponents.TableEditor = function () {
            return {
                defaultColumnText: '',
                defaultCellText: '',
                headings: [{!! $headings !!}],
                rows: [
                    @foreach($items as $item)
                        [{!! "'".implode(" ',' ",$item)."'"!!}],
                    @endforeach
                ],

                addColumn() {
                    this.headings.push(this.defaultColumnText)

                    this.rows.forEach(row => {
                        row.push(this.defaultCellText)
                    })
                },
                removeColumn(index) {
                    this.headings.splice(index, 1)
                    this.rows.forEach(row => {
                        row.splice(index, 1)
                    })
                },
                addRow() {
                    const row = []
                    for (let i = 0; i < this.headings.length; i++) {
                        if (i === 0) {
                            row.push(this.rows.length + 1)
                        } else {
                            row.push(this.defaultCellText)
                        }
                    }
                    this.rows.push(row)
                },

                addNextRaw(index) {
                    console.log(index)
                    const row = []
                    for (let i = 0; i < this.headings.length; i++) {
                        if (i === 0) {
                            row.push(this.rows.length + 1)
                        } else {
                            row.push(this.defaultCellText)
                        }
                    }
                    this.rows = [
                        ...this.rows.slice(0, index + 1),
                        row,
                        ...this.rows.slice(index + 1)
                    ];
                },

                removeRow(index) {
                    this.rows.splice(index, 1)
                },

                useDefaultTemplate() {
                    this.$el.innerHTML = this.defaultTemplate
                },


            }
        }

    </script>
@endpush
<x-main::accordion-editor :title="__('table')" :open="$open">
    <section>
        <main::x-box>
                <div class="flex flex-col max-h-screen w-full" x-data="AlpineComponents.TableEditor()">
                    <div class="flex-grow overflow-auto">
                        <table class="relative w-full border">
                            <thead class="bg-white dark:bg-slate-700">
                            <tr>
                                <template x-for="(heading, headingIndex) in headings" :key="headingIndex">
                                    <th class="px-6 py-1">
                                        <button type="button" role="button" x-on:click="removeColumn(headingIndex)"
                                                class="font-semibold uppercase text-sm bg-white rounded shadow p-1"
                                                x-show="headingIndex > 0 && headings.length > 2">
                                            -
                                        </button>
                                    </th>
                                </template>
                            </tr>
                            <tr>
                                <template x-for="(heading, headingIndex) in headings" :key="headingIndex">
                                    <th class="top-0 px-6 py-1">
                                        <x-main::input.text type="text" x-model="headings[headingIndex]" class="w-full !p-1"
                                                            x-bind:name="`extra[table][titles][]`"/>
                                    </th>
                                </template>
                                <th class="px-6 py-3" rowspan="1">
                                    <button type="button" role="button" x-on:click="addColumn"
                                            class="font-semibold uppercase text-sm bg-white rounded shadow p-1" >
                                        +
                                    </button>
                                </th>
                            </tr>
                            </thead>
                            <tbody class="divide-y bg-white  dark:bg-slate-700">
                            <template x-for="(row, rowIndex) in rows" :key="rowIndex">
                                <tr>
                                    <template x-for="(column, columnIndex) in row" :key="columnIndex">
                                        <td class="px-6 py-4 text-center">
                                            <x-main::input.textarea type="text" x-bind:name="`extra[table][options][${rowIndex}][]`"
                                                                    class="w-full !p-1"
                                                                    x-model="rows[rowIndex][columnIndex]"
                                            ></x-main::input.textarea>
                                        </td>
                                    </template>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex flex-col gap-1">
                                            <button type="button" role="button"
                                                    class="font-semibold uppercase text-sm bg-white rounded shadow p-1"
                                                    x-on:click="removeRow(rowIndex)">
                                                -
                                            </button>

                                            <button type="button" role="button"
                                                    class="font-semibold uppercase text-sm bg-white rounded shadow p-1"
                                                    x-on:click="addNextRaw(rowIndex)">
                                                +
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </template>

                            <tr x-cloak>
                                <td class="px-6 py-4 text-center" :colspan="headings.length + 1">
                                    <button x-on:click="addRow" type="button" role="button"
                                            class="font-semibold uppercase text-sm bg-white rounded shadow p-1" >
                                        +
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
        </main::x-box>
    </section>
</x-main::accordion-editor>
